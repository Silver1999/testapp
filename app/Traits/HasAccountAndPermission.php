<?php
namespace App\Traits;

use App\Account;
use App\Permission;

trait HasAccountAndPermission
{
    /**
     * @return mixed
     */
    public function account()
    {
        return $this->hasOne(Account::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }
    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission);
    }
    /**
     * @param array $permissions
     * @return mixed
     */
    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug',$permissions)->get();
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }
}
