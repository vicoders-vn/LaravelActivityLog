<?php
namespace Vicoders\ActivityLog\Traits;

use App\Entities\Manager;
use App\Entities\Order;
use App\Entities\Trip;
use App\Entities\User;

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

    public function simplize()
    {
        $data = [];
        foreach ($this as $key => $obj) {
            switch (true) {
                case $obj instanceof User:
                    $data[$key] = ['id' => $obj->id, 'email' => $obj->email];
                    break;
                case $obj instanceof Order:
                    $data[$key] = ['id' => $obj->id];
                    break;
                case $obj instanceof Trip:
                    $data[$key] = ['id' => $obj->id];
                    break;
                case $obj instanceof Manager:
                    $data[$key] = ['id' => $obj->id];
                    break;
                default:
                    $data[$key] = $obj;
                    break;
            }
        }
        return $data;
    }

}
