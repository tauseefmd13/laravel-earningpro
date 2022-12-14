<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('user_access'), Response::HTTP_FORBIDDEN);

        $users = User::with('role')->get();

        if(request()->ajax()) {
            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('checkAll', function($row) {
                    return '<input type="checkbox" class="sub-check" onclick="checkAllCheckbox();" data-id="'.$row->id.'">';
                })
                ->addColumn('role_name', function($row) {
                    return '<span class="badge badge-info">'.$row->role->name.'</span>';
                })
                ->editColumn('status', function($row) {
                    $checked = ($row->status == 1) ? 'checked' : '';
                    return '<div class="custom-control custom-switch custom-switch-lg"><input type="checkbox" name="status" data-url="'.route('admin.users.update.status').'" data-id="'.$row->id.'" class="custom-control-input js-switch" id="customSwitch'.$row->id.'" '.$checked.'><label class="custom-control-label" for="customSwitch'.$row->id.'"></label></div>';
                })
                ->editColumn('created_at', function($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->addColumn('action', function($row) {
                    return view('admin.includes.datatablesActions', [
                        'crudRoutePart' => 'users',
                        'row' => $row,
                    ]);
                })
                ->rawColumns(['checkAll', 'role_name', 'status', 'action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('user_create'), Response::HTTP_FORBIDDEN);

        $roles = Role::all()->pluck('name','id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        abort_unless(\Gate::allows('user_create'), Response::HTTP_FORBIDDEN);

        User::create($request->all());

        return redirect()->route('admin.users.index')->with('success','User added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_unless(\Gate::allows('user_show'), Response::HTTP_FORBIDDEN);

        $user->load('role');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), Response::HTTP_FORBIDDEN);

        $roles = Role::all()->pluck('name','id');

        $user->load('role');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('user_edit'), Response::HTTP_FORBIDDEN);

        $data = $request->except('password');

        if($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success','User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user_delete'), Response::HTTP_FORBIDDEN);

        $user->delete();

        return redirect()->route('admin.users.index')->with('success','User deleted successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        abort_unless(\Gate::allows('user_edit'), Response::HTTP_FORBIDDEN);

        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\MassDestroyUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyUserRequest $request)
    {
        abort_unless(\Gate::allows('user_delete'), Response::HTTP_FORBIDDEN);

        User::whereIn('id', request('ids'))->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }
}
