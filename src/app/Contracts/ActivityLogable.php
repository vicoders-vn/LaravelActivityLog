<?php
namespace Vicoders\ActivityLog\Contracts;

interface ActivityLogable
{
    public function getMeta();
    public function getMetaType();
    public function simplize();
}
