<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

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

      return view('admin.roles.index', $details);
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
      $permission = Permission::where('guard_name', 'web')->get();
      return view('admin.roles.create', compact('permission'));
    } catch (\Exception $ex) {
      toastr()->success($ex->getMessage());
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
      'name'            => 'required|unique:roles,name',
      'permission'      => 'required',

    ]);

    if ($validate->fails()) {
      toastr()->error($validate->messages());
      return redirect()->back()->withInput();
    }

    $check =  Role::where('name', $request->input('name'))->first();

    if ($check) {
      toastr()->error('Name Alredy Exits');
      return redirect()->back()->withInput();
    }

    $role = Role::create(['name' => $request->input('name')]);
    $role->syncPermissions($request->input('permission'));

    return redirect('admin/roles');
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

    return view('admin.roles.show', compact('role', 'rolePermissions'));
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
      $details['detail'] = Role::find($id);
      $details['permission'] = Permission::where('guard_name', 'web')->get();
      $details['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();

      return view('admin.roles.edit', $details);
    } catch (\Exception $ex) {
      toastr()->success($ex->getMessage());
      return back()->with('error', $ex->getMessage());
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
      'name'              => 'required|unique:roles,name,' . $id,
      'permission'        => 'required',

    ]);

    if ($validate->fails()) {

      toastr()->error($validate->messages());
      return redirect()->back()->withInput();
    }

    $role = Role::find($id);
    $role->name = $request->input('name');
    $role->save();

    $role->syncPermissions($request->input('permission'));

    return redirect('admin/roles')
      ->with('success', 'Role updated successfully');
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
