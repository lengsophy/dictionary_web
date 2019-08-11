<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Session;
use DataTables;
use DB;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!is_permission('admin_user')) {
            return view('errors.404');
        }
        $data['users'] =  DB::table('role_user')
                        ->select('users.*', 'roles.name as role_name')
                        ->join('users', 'role_user.user_id', '=', 'users.id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->where('users.deleted_at', null)
                        ->where('roles.deleted_at', null)
                        ->paginate(10);
        return view('user.index', $data);
    }
    /**
     * Add new customer
     */
    public function add(Request $request)
    {
        if (!is_permission('admin_user')) {
            return view('errors.404');
        }
        if (!$_POST) {
            $data['role'] = Role::get();
            return view('user.add', $data);
        } else {
            $validation = $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'role' => ['required'],
                'password' => ['required', 'string', 'min:6'],
                'password_confirmation' => 'required|required_with:password|same:password',
            ]);
            if ($validation) {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                if ($request->role) {
                    $user_id = User::latest('id')->first();
                    DB::table('role_user')->insert([
                        ['user_id' =>$user_id->id , 'role_id' => $request->role]
                    ]);
                }
            }
            flash_message('success', 'Add New User Successfully');
            return redirect("user");
        }
    }

    /**
     * Update User
     */
    public function edit(Request $request)
    {
        if (!is_permission('admin_user')) {
            return view('errors.404');
        }
        if (!$_POST) {
            $data['user'] = User::where('id', $request->id)->first();
            $data['role'] = Role::get();
            $data['role_user'] = DB::table('role_user')->where('user_id', $request->id)->first();
            return view('user.edit', $data);
        } else {
            //Check password change or not
            if (empty($request->password)) {
                $validation = $request->validate([
                'name' => 'required',
                "email"     =>'required|email|unique:users,email,'.$request->id.',id',
            ]);
                if ($validation) {
                    user::where('id', $request->id)
                ->update([
                    'name'   =>  $request->name,
                    'email'     =>  $request->email,
                ]);
                    //Update role Admin
                    if ($request->role) {
                        DB::table('role_user')
                    ->where('user_id', $request->id)
                    ->update(
                        ["role_id" => $request->role]
                    );
                    }
                }
            } else {
                $validation = $request->validate([
                'name' => 'required',
                "email"     =>'required|email|unique:users,email,'.$request->id.',id',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|required_with:password|same:password',
            ]);
                if ($validation) {
                    User::where('id', $request->id)
                ->update([
                    'name'     =>  $request->name,
                    'email'    =>  $request->email,
                    'password' => Hash::make($request->password)
                    ]);
                    if ($request->role) {
                        DB::table('role_user')
                    ->where('user_id', $request->id)
                    ->update(
                        ["role_id" => $request->role]
                    );
                    }
                }
            }
            flash_message('success', 'Update User Successfully');
            return redirect('user');
        }
    }

    /** Delete user Admin */
    public function delete(Request $request)
    {
        if (!is_permission('admin_user')) {
            return view('errors.404');
        }
        $user= User::where('id', $request->id)->update([
                        'deleted_at' => date('Y-m-d H:i:s'),
                        'deleted_by' => Auth::user()->id,
                    ]);
        if ($user) {
            flash_message('success', 'Delete Successfully');
            return redirect('user');
        }
    }
    // user disnable
    public function disable(Request $request)
    {
        if (!is_permission('admin_user')) {
            return view('errors.404');
        }
        $disable = User::where('id', $request->id)->update(['status' => 0]);
        if ($disable) {
            flash_message('success', 'Disable User Successfully');
            return redirect('user');
        }
    }
    // user enable
    public function enable(Request $request)
    {
        if (!is_permission('admin_user')) {
            return view('errors.404');
        }
        $enable = User::where('id', $request->id)->update(['status' => 1]);
        if ($enable) {
            flash_message('success', 'Enable User Successfully');
            return redirect('user');
        }
    }

    //Profile
    public function profile(Request $request)
    {
        if (!$_POST) {
            return view('user.profile');
        } else {
            if (empty($request->password)) {
                $validation = $request->validate([
                    'name' => 'required',
                    "email"     =>'required|email|unique:users,email,'.Auth::user()->id.',id',
                ]);
                if ($validation) {
                    User::where('id', Auth::user()->id)
                    ->update([
                        'name'   =>  $request->name,
                        'email'     =>  $request->email,
                    ]);
                    //Uploading Image
                    if ($request->profile_image) {
                        $validation = $request->validate([
                            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);
                        if ($validation) {
                            $image = imageUploadPost($request->profile_image);
                            User::where('id', Auth::user()->id)
                            ->update([
                                'profile_image'   =>  $image,
                            ]);
                        }
                    }
                }
            } else {
                $validation = $request->validate([
                    'name' => 'required',
                    "email"     =>'required|email|unique:users,email,'.Auth::user()->id.',id',
                    'password' => 'required',
                    'password_confirmation' => 'required|required_with:password|same:password',
                ]);
                if ($validation) {
                    User::where('id', Auth::user()->id)
                    ->update([
                        'name'     =>  $request->name,
                        'email'    =>  $request->email,
                        'password' => Hash::make($request->password)
                    ]);
                    //Uploading images
                    if ($request->profile_image) {
                        $validation = $request->validate([
                            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        ]);
                        if ($validation) {
                            $image = imageUploadPost($request->profile_image);
                            User::where('id', Auth::user()->id)
                            ->update([
                                'profile_image'   =>  $image,
                            ]);
                        }
                    }
                }
            }
        }
        flash_message('success', 'Update Profile Successfully');
        return redirect('/');
    }
}
