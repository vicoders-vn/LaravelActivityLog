<?php
namespace Vicoders\ActivityLog\Traits;

use App\Entities\Manager;
use App\Entities\Order;
use App\Entities\Trip;
use App\Entities\User;
use Illuminate\Support\Facades\App;

trait ActivityLogTrait
{
    public function getMeta()
    {
        return '';
    }

    public function getMetaType()
    {
        return '';
    }

    public function getDescription()
    {
        return '';
    }

    public function simplize()
    {
        
        return App::make(\Vicoders\ActivityLog\Services\Simplize\Constracts\Simplize::class)->simplize($this);
    }

}
