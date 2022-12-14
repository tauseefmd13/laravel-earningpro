<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('permission_access'), Response::HTTP_FORBIDDEN);

        $permissions = Permission::all();

        if(request()->ajax()) {
            return datatables()->of($permissions)
                ->addIndexColumn()
                ->addColumn('checkAll', function($row) {
                    return '<input type="checkbox" class="sub-check" onclick="checkAllCheckbox();" data-id="'.$row->id.'">';
                })
                ->editColumn('created_at', function($row) {
                    return Carbon::parse($row->created_at)->toDateTimeString();
                })
                ->addColumn('action', function($row) {
                    return view('admin.includes.datatablesActions', [
                        'crudRoutePart' => 'permissions',
                        'row' => $row,
                    ]);
                })
                ->rawColumns(['checkAll', 'action'])
                ->make(true);
        }

        return view('admin.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('permission_create'), Response::HTTP_FORBIDDEN);

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        abort_unless(\Gate::allows('permission_create'), Response::HTTP_FORBIDDEN);

        Permission::create($request->all());

        return redirect()->route('admin.permissions.index')->with('success','Permission added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        abort_unless(\Gate::allows('permission_show'), Response::HTTP_FORBIDDEN);

        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        abort_unless(\Gate::allows('permission_edit'), Response::HTTP_FORBIDDEN);

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdatePermissionRequest  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        abort_unless(\Gate::allows('permission_edit'), Response::HTTP_FORBIDDEN);

        $permission->update($request->all());

        return redirect()->route('admin.permissions.index')->with('success','Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        abort_unless(\Gate::allows('permission_delete'), Response::HTTP_FORBIDDEN);

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success','Permission deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\MassDestroyPermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        abort_unless(\Gate::allows('permission_delete'), Response::HTTP_FORBIDDEN);
        
        Permission::whereIn('id', request('ids'))->delete();

        return response()->json(['message' => 'Permission deleted successfully.']);
    }
}
