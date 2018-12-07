<?php

namespace Vicoders\ActivityLog\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ActivityLog.
 *
 * @package namespace App\Entities;
 */
class ActivityLog extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event',
        'payload',
        'meta',
        'meta_type',
    ];
}
