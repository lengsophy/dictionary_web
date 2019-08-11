<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
    protected $table = 'roles';
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description', 'key',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo(Permission $permission) {
        return $this->permissions()->save($permission);
    }

    public static function permission_role($id)
    {
        return DB::table('permission_role')->where('role_id', $id)->pluck('permission_id')->toArray();
    }
}
