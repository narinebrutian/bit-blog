<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role_id', 'email'];

    public function roles()
    {
        return $this->hasOne(Role::class);
    }
}
