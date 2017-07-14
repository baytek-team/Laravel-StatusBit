<?php

namespace Baytek\LaravelStatusBit;

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
            0                  => __('No Status'),
            static::ARCHIVED   => __('Archived'),
            static::DISABLED   => __('Disabled'),
            static::DELETED    => __('Deleted'),
            static::REMOVED    => __('Removed'),
            static::DRAFT      => __('Draft'),
            static::FEATURED   => __('Featured'),
            static::APPROVED   => __('Approved'),
            static::DECLINED   => __('Declined'),
            static::RESTRICTED => __('Restricted'),
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