<?php

namespace Vicoders\ActivityLog\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Vicoders\ActivityLog\Entities\ActivityLog;
use Vicoders\ActivityLog\Repositories\ActivityLogRepository;

/**
 * Class ActivityLogRepositoryEloquent.
 *
 * @package namespace Vicoders\ActivityLog\Repositories;
 */
class ActivityLogRepositoryEloquent extends BaseRepository implements ActivityLogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ActivityLog::class;
    }

    public function getEntity()
    {
        return $this->model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
