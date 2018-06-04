<?php

namespace Baytek\LaravelStatusBit;

use Illuminate\Support\Collection;

class StatusMessages implements Interfaces\StatusMessageInterface, Interfaces\StatusInterface
{
	/**
	 * List of default messages
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
     * Get the collection of status messages
     * @return Illuminate\Support\Collection Collection of messages
     */
    public function messages()
    {
        return static::$statuses;
    }
}