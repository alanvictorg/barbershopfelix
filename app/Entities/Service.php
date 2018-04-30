<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Service.
 *
 * @package namespace App\Entities;
 */
class Service extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'status',
        'scheduled_day',
        'scheduled_hour'
    ];

    public function itens()
    {
        return $this->hasMany(ServiceItem::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
