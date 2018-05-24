<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Role.
 *
 * @package namespace App\Entities;
 */
class Role extends Model implements Transformable
{
    use TransformableTrait;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name','slug','description'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function moduleRoles()
    {
        return $this->hasMany(ModuleRole::class);
    }

}
