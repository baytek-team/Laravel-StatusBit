<?php

/*
 * This file is part of the Laravel StatusBit package.
 *
 * (c) Yvon Viger <yvon@baytek.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Baytek\Laravel\StatusBit;

use Illuminate\Support\Collection;

class StatusMessages implements Interfaces\StatusMessageInterface, Interfaces\StatusInterface
{
	/**
	 * List of default messages
	 * @var Illuminate\Support\Collection
	 */
	public static $statuses;

    /**
     * Status message constructor
     */
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
     * Get the list of StatusMessages
     * @return Illuminate\Support\Collection Collection of statuses
     */
    public function messages()
    {
        return static::$statuses;
    }
}