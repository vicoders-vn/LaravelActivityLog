<?php

namespace Vicoders\ActivityLog\Listeners;

use App\Entities\User;
use VCComponent\Laravel\User\Events\UserCreatedByAdminEvent;
use VCComponent\Laravel\User\Events\UserRegisteredEvent;
use Vicoders\ActivityLog\Entities\ActivityLog;

class ActivityLogListener
{
    public function handle($event)
    {
        foreach ($event as $key => $obj) {
            $event->{$key} = $this->simplize($obj);
        }

        if ($event instanceof ActivityLogable) {
            $data = [
                'event'     => get_class($event),
                'payload'   => json_encode($event),
                'meta'      => $event->getMeta(),
                'meta_type' => $event->getMetaType(),
            ];
        } else {
            $data = [
                'event'   => get_class($event),
                'payload' => json_encode($event),
            ];
        }
        ActivityLog::create($data);
    }

    public function simplize($obj)
    {
        switch (true) {
            case $obj instanceof User:
                return ['id' => $obj->id, 'email' => $obj->email];
                break;
            default:
                return $obj;
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            UserCreatedByAdminEvent::class,
            'App\Listeners\ActivityLogListener@handle'
        );

        $events->listen(
            UserRegisteredEvent::class,
            'App\Listeners\ActivityLogListener@handle'
        );
    }
}
