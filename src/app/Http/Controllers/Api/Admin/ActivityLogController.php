<?php
namespace Vicoders\ActivityLog\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use VCComponent\Laravel\Vicoders\Core\Exceptions\PermissionDeniedException;
use Vicoders\ActivityLog\Contracts\Controllers\Api\Admin\ActivityLogInterface;
use Vicoders\ActivityLog\Http\Controllers\Api\ApiController;
use Vicoders\ActivityLog\Repositories\ActivityLogRepository;
use Vicoders\ActivityLog\Transformers\ActivityLogTransformer;

class ActivityLogController extends ApiController implements ActivityLogInterface
{
    protected $repository;
    protected $entity;
    protected $transformer;

    public function __construct(ActivityLogRepository $repository, ActivityLogTransformer $transformer)
    {
        $this->repository  = $repository;
        $this->entity      = $repository->getEntity();
        $this->transformer = $transformer;
        $this->middleware('jwt.auth', ['except' => []]);
    }

    public function index(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        if (!$this->entity->ableToView($user)) {
            throw new PermissionDeniedException();
        }

        $query = $this->entity;
        $query = $this->applySearchFromRequest($query, ['event', 'description'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);

        $per_page = $request->has('per_page') ? (int) $request->get('per_page') : 15;
        $items    = $query->paginate($per_page);

        return $this->response->paginator($items, $this->transformer);
    }
}
