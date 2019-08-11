<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Role;
use App\Models\Permission;
use Session;
use Auth;

class RoleController extends Controller
{
    /**
     * View Role and permssion
     */
    public function view()
    {
        if (!is_permission('role_permission')) {
            return view('errors.404');
        }
        $data['role'] = DB::table('roles')->select('roles.*')->orderBy('id', 'DESC')->paginate(10);
        return view('role.index', $data);
    }
    /**
     * Get json Role and permission
     */
    public function getrole()
    {
        $role = Role::select('roles.*')->get();
        return datatables()->of($role)
         ->addColumn('action', function ($role) {
             $edit = '<a href="role/edit/'.$role->id.'" class="btn btn-link"><i class="fa fa-edit" data-toggle="tooltip" title="Edit" style="font-size:20px"></i></a>';
             $permission = '<a href="role/permission/'.$role->id.'" class="btn btn-link"><i class="fa fa-th" data-toggle="tooltip" title="Permission" style="font-size:20px"></i></a>';
             $delete = '<button class="btn btn-link" data-href="role/delete/'.$role->id.'" data-toggle="modal"  data-target="#confirm-delete"><i class="fa fa-remove" data-toggle="tooltip" title="Delete" style="font-size:18px"></i></button>';
             return $edit.$delete.$permission;
         })
        ->make(true);
    }
    /**
     * Add new role
     */
    public function add(Request $request)
    {
        if (!is_permission('role_permission')) {
            return view('errors.404');
        }
        if (!$_POST) {
            return view('role.add');
        } else {
            $validation = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'display_name' => 'required',
            ]);
            if ($validation) {
                $str = strtolower($request->name);
                $key = str_replace(' ', '_', trim($str));
                Role::create([
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'description' => $request->description,
                    'key' => $key
                ]);
            }
            flash_message('success', 'Add Successfully');
            return redirect("role");
        }
    }
    /**
     * Edit role
     */
    public function edit(Request $request)
    {
        if (!is_permission('role_permission')) {
            return view('errors.404');
        }
        if (!$_POST) {
            $data['role'] = Role::where('id', $request->id)->first();
            return view('role.edit', $data);
        } else {
            $validation = $request->validate([
                'name' => 'required|unique:roles,name,' . $request->id .',id',
                'display_name' => 'required',
            ]);
            if ($validation) {
                Role::where('id', $request->id)->update([
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'description' => $request->description,
                ]);
            }
            flash_message('success', 'Add Successfully');
            return redirect("role");
        }
    }
    /**
     * Permission
     */
    public function permission(Request $request)
    {
        if (!is_permission('role_permission')) {
            return view('errors.404');
        }
        if (!$_POST) {
            $data['result'] = Role::find($request->id);
            $data['stored_permissions'] = Role::permission_role($request->id);
            $data['permissions'] = Permission::get();
            return view('role.permission', $data);
        } else {
            if ($request->permission) {
                DB::table('permission_role')->where('role_id', $request->id)->delete();
                foreach ($request->permission as $row) {
                    $get_permission_id = Permission::where('name', $row)->get();
                    foreach ($get_permission_id as $permission_id) {
                        $permission_role[] = [
                                'role_id' => $request->id,
                                'permission_id' => $permission_id->id,
                                'permission_key' => $row,
                                'role_key' => $request->role_key
                            ];
                    }
                }
                DB::table('permission_role')->insert($permission_role);
            }
            flash_message('success', 'Update Successfully');
            return redirect("role");
        }
    }
    /**
     * Delete role and permission
     */
    public function delete(Request $request)
    {
        if (!is_permission('role_permission')) {
            return view('errors.404');
        }
        $id = $request->id;
        $permission_role= DB::table('permission_role')->where('role_id', $id)->delete();
        $role = Role::where('id', $id)->delete();
        if ($role) {
            flash_message('success', 'Delete Successfully');
            return redirect('role');
        }
    }

    // Check role key is exist
    public function check_role_key(Request $request)
    {
        $key = Role::where('name', $request->name)->first();
        if ($key) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }
}
