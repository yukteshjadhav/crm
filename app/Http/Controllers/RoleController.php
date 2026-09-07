<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
  #Bind Role model
  protected $role;
  /**
   * Defining the default constructor for controller
   *
   */
  public function __construct(
    Role $role
  ) {
    // $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
    // $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
    // $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
    // $this->middleware('permission:role-delete', ['only' => ['destroy']]);

    $this->role                           = $role;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    try {

      $input = $request->all();

      #get all paymentrole resources 'subscripation_id' => franchising()
      $roles = $this->role->where('created_at', '!=', null);

      $search_name = '';
      if (isset($input['search_name'])) {
        $search_name = $input['search_name'];
        if (isset($search_name) && $search_name != null) {
          $roles->where('name', 'LIKE', '%' . $search_name . '%');
        }
      }
      $details['lists'] = $roles->orderBy('id', 'DESC')->paginate(10);

      return view('roles.index', $details);
    } catch (\Exception $ex) {
      toastr()->success($ex->getMessage());
      return back()->with('error', $ex->getMessage());
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function create()
    {
        try {
    
            $permissions = Permission::where('guard_name', 'web')
                ->get()
                ->groupBy(function ($permission) {
                    return explode('-', $permission->name)[0];
                });
    
            return view('roles.create', compact('permissions'));
    
        } catch (\Exception $ex) {
    
            toastr()->error($ex->getMessage());
    
            return back()->with('error', $ex->getMessage());
        }
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array|min:1',
            'permission.*' => 'integer|exists:permissions,id',
        ], [
            'name.required' => 'Role name is required.',
            'name.unique' => 'Role name already exists.',
            'permission.required' => 'Please select at least one permission.',
            'permission.min' => 'Please select at least one permission.',
            'permission.*.exists' => 'Invalid permission selected.',
        ]);
    
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    
        $role = Role::create([
            'name' => $request->name,
        ]);
    
        // Get Permission models using IDs
        $permissions = Permission::whereIn('id', $request->permission)
            ->where('guard_name', 'web')
            ->get();
    
        // Sync Permission models
        $role->syncPermissions($permissions);
        return redirect('admin/roles')
                ->with('success', 'Role created successfully.');
    }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
      public function show($id)
      {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
          ->where("role_has_permissions.role_id", $id)
          ->get();
    
        return view('roles.show', compact('role', 'rolePermissions'));
      }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function edit($id)
    {
        try {
    
            $role = Role::findOrFail($id);
    
            $permissions = Permission::where('guard_name', 'web')
                ->get()
                ->groupBy(function ($permission) {
                    return explode('-', $permission->name)[0];
                });
    
            // Get currently assigned permission IDs
            $assignedPermissions = $role->permissions
                ->pluck('id')
                ->toArray();
    
            return view('roles.edit', compact(
                'role',
                'permissions',
                'assignedPermissions'
            ));
    
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required|array|min:1',
            'permission.*' => 'integer|exists:permissions,id',
        ], [
            'name.required' => 'Role name is required.',
            'name.unique' => 'Role name already exists.',
            'permission.required' => 'Please select at least one permission.',
            'permission.min' => 'Please select at least one permission.',
            'permission.*.exists' => 'Invalid permission selected.',
        ]);
    
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
    
        try {
    
            $role = Role::findOrFail($id);
    
            $role->update([
                'name' => $request->name,
            ]);
    
            $permissions = Permission::whereIn('id', $request->permission)
                ->where('guard_name', 'web')
                ->get();
    
            $role->syncPermissions($permissions);
            
            return redirect('admin/roles')
                ->with('success', 'Role updated successfully.');
        } catch (\Exception $ex) {
    
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    DB::table("roles")->where('id', $id)->delete();
    return redirect()->route('roles.index')
      ->with('success', 'Role deleted successfully');
  }
}
