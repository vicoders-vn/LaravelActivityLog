<?php
namespace Vicoders\ActivityLog\Services\Simplize;

use Vicoders\ActivityLog\Services\Simplize\Constracts\Simplize as SimplizeInterface;

class Simplize implements SimplizeInterface
{
    public function simplize($event)
    {
        $data = [];
        foreach ($event as $key => $obj) {
            if (!empty($obj->id)) {
                $data[$key] = ['id' => $obj->id];
            } else {
                $data[$key] = $obj;
            }
        }
        return $data;
    }
}
