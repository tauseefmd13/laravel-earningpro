<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('role_access'), Response::HTTP_FORBIDDEN);

        $roles = Role::with('permissions')->get();

        if(request()->ajax()) {
            return datatables()->of($roles)
                ->addIndexColumn()
                ->addColumn('checkAll', function($row) {
                    return '<input type="checkbox" class="sub-check" onclick="checkAllCheckbox();" data-id="'.$row->id.'">';
                })
                ->addColumn('permissions', function($row) {
                    if($row->name == 'Admin') {
                        return '<span class="badge badge-info lessText">'.__('All permissions').'</span>';
                    }

                    return $row->permissions->map(function($permission, $index) {
                        return '<span class="badge badge-info lessText">'.$permission->name.'</span>';
                    })->implode(' ');
                })
                ->editColumn('created_at', function($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->addColumn('action', function($row) {
                    return view('admin.includes.datatablesActions', [
                        'crudRoutePart' => 'roles',
                        'row' => $row,
                    ]);
                })
                ->rawColumns(['checkAll', 'permissions', 'action'])
                ->make(true);
        }

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('role_create'), Response::HTTP_FORBIDDEN);

        $permissions = Permission::all()->pluck('name','id');

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        abort_unless(\Gate::allows('role_create'), Response::HTTP_FORBIDDEN);

        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success','Role added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        abort_unless(\Gate::allows('role_show'), Response::HTTP_FORBIDDEN);

        $role->load('permissions');

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        abort_unless(\Gate::allows('role_edit'), Response::HTTP_FORBIDDEN);

        $permissions = Permission::all()->pluck('name','id');

        $role->load('permissions');

        return view('admin.roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateRoleRequest  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_unless(\Gate::allows('role_edit'), Response::HTTP_FORBIDDEN);

        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success','Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_unless(\Gate::allows('role_delete'), Response::HTTP_FORBIDDEN);

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success','Role deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\MassDestroyRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyRoleRequest $request)
    {
        abort_unless(\Gate::allows('role_delete'), Response::HTTP_FORBIDDEN);

        Role::whereIn('id', request('ids'))->delete();

        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
