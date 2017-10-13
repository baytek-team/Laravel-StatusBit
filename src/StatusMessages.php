<?php

namespace Baytek\Laravel\StatusBit;

use Illuminate\Support\Collection;

class StatusMessages implements Interfaces\StatusMessageInterface, Interfaces\StatusInterface
{
	/**
	 * List of default messages
	 * @var [type]
	 */
	public static $statuses;

    public function __construct()
    {
        static::$statuses = new Collection([
            0                  => 'No Status',
            static::ARCHIVED   => 'Archived',
            static::DISABLED   => 'Disabled',
            static::DELETED    => 'Deleted',
            static::REMOVED    => 'Removed',
            static::DRAFT      => 'Draft',
            static::FEATURED   => 'Featured',
            static::APPROVED   => 'Approved',
            static::DECLINED   => 'Declined',
            static::RESTRICTED => 'Restricted',
        ]);
    }

    /**
     * [messages description]
     * @return [type] [description]
     */
    public function messages()
    {
        return static::$statuses;
    }
}