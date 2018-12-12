<?php
namespace Vicoders\ActivityLog\Contracts\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Vicoders\ActivityLog\Repositories\ActivityLogRepository;
use Vicoders\ActivityLog\Transformers\ActivityLogTransformer;

interface ActivityLogInterface
{
    public function __construct(ActivityLogRepository $repository, ActivityLogTransformer $transformer);
    public function index(Request $request);
}
