<?php
    use App\Models\PermissionRole as PermissionRole;

// Set Flash Message function
    function flash_message($class, $message)
    {
        Session::flash('alert-class', 'alert-'.$class);
        Session::flash('message', $message);
    }
       
    //return current user
    function current_user()
    {
        return Auth::user();
    }

    //this function will check user role
    function user_role()
    {
        if (current_user()) {
            $user_id = current_user()->id;
            $roles = DB::table('role_user')
                        ->select('users.*', 'roles.*')
                        ->join('users', 'role_user.user_id', '=', 'users.id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->where('role_user.user_id', current_user()->id)
                        ->where('users.deleted_at', null)
                        ->where('roles.deleted_at', null)
                        ->get()->first();
            return $roles;
        }
        return false;
    }

    //permision by module
    function is_permission($module)
    {
        $role = user_role()->key;
        if ($module) {
            if (current_user()) {
                $permission = PermissionRole::where('role_key', $role)
                                ->where('permission_key', $module)
                                ->count();
            }
            if ($permission>0) {
                return true;
            } else {
                return false;
            }
        }
    }

    function imageUploadPost($fileName)
    {
        $imageName = time().'.'.$fileName->getClientOriginalExtension();
        $fileName->move(public_path('assets/img/profile'), $imageName);
        return $imageName;
    }
