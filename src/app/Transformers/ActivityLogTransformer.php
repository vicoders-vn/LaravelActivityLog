<?php

namespace Vicoders\ActivityLog\Transformers;

use League\Fractal\TransformerAbstract;
use Vicoders\ActivityLog\Entities\ActivityLog;

class ActivityLogTransformer extends TransformerAbstract
{
    public function transform(ActivityLog $model)
    {
        return [
            'id'         => (int) $model->id,
            'event'      => $model->event,
            'payload'    => $model->payload,
            'meta'       => (int) $model->meta,
            'meta_type'  => $model->meta_type,
            'timestamps' => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }
}
