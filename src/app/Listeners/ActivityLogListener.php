<?php

namespace Vicoders\ActivityLog\Listeners;

use App\Entities\User;
use App\Events\CoordinationSucceededEvent;
use App\Events\DeleteCoordinatedOrderEvent;
use App\Events\VehicleMaintenanceReminderEvent;
use VCComponent\Laravel\User\Events\UserCreatedByAdminEvent;
use VCComponent\Laravel\User\Events\UserDeletedEvent;
use VCComponent\Laravel\User\Events\UserEmailVerifiedEvent;
use VCComponent\Laravel\User\Events\UserLoggedInEvent;
use VCComponent\Laravel\User\Events\UserRegisteredBySocialAccountEvent;
use VCComponent\Laravel\User\Events\UserRegisteredEvent;
use VCComponent\Laravel\User\Events\UserUpdatedByAdminEvent;
use VCComponent\Laravel\User\Events\UserUpdatedEvent;
use Vicoders\ActivityLog\Contracts\ActivityLogable;
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
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            UserRegisteredEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            UserEmailVerifiedEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            UserLoggedInEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            UserDeletedEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            UserUpdatedByAdminEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            UserUpdatedEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            UserRegisteredBySocialAccountEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            CoordinationSucceededEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            VehicleMaintenanceReminderEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
        $events->listen(
            DeleteCoordinatedOrderEvent::class,
            'Vicoders\ActivityLog\Listeners\ActivityLogListener@handle'
        );
    }
}
