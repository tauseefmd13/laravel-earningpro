<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthGatesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user) {
            // Implicitly grant "Admin" role all permissions
            if($user->hasRole('Admin')) {
                Gate::before(function ($user, $ability) {
                    return true;
                });
            }

            $permissionsArray = [];
            $roles = Role::with('permissions')->get();
            
            foreach ($roles as $role) {
                foreach ($role->permissions as $permission) {
                    $permissionsArray[$permission->name][] = $role->id;
                }
            }

            foreach ($permissionsArray as $name => $roleId) {
                Gate::define($name, function (User $user) use ($roleId) {
                    return in_array($user->role_id, $roleId) ? true : false;
                });
            }
        }

        return $next($request);
    }
}
