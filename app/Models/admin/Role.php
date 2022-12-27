<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function admins(){
        return $this->belongsTo(Admin::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'permission_id', 'role_id');
    }


}
