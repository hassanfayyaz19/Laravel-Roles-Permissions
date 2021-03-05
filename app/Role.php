<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Role extends Model
{
    use SoftDeletes;
    protected $fillable=['name','slug','permissions'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    public function hasAccess(array $permissions)
    {
        Log::alert($permissions);
        foreach ($permissions as $permission) {

            if ($this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }
    protected function hasPermission(string $permission)
    {

        $permissions=json_decode($this->permissions, true);
      //  Log::alert($permissions[$permission]);
        return $permissions[$permission]??false;
    }
}
