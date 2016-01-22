<?php

/*
 * This file is part of the Laravel StatusBit package.
 *
 * (c) Yvon Viger <yvon@baytek.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Baytek\LaravelStatusBit;

trait StatusTrait {

    // System Reserved status bits - upto 256
    const ARCHIVED = 1;  // 2^0
    const DISABLED = 2;  // 2^1
    const DELETED  = 4;  // 2^2
    const DRAFT    = 8;  // 2^3
    const FEATURED = 16; // 2^4
    // const SYS_RESERVED_TBD_1 = 32;  // 2^5
    // const SYS_RESERVED_TBD_2 = 64;  // 2^6
    // const SYS_RESERVED_TBD_3 = 128; // 2^7
    // const SYS_RESERVED_TBD_4 = 256; // 2^8

    // combined bits
    const REMOVED = 6;

    // Application Specific status bits - up to 2^32
    // Should be defined in each model that contains a status trait so it can be specific to the model.
    // TODO: Write a protected method of models adding statuses so they don't use the system reserved statuses

	/**
     * @param Builder $query Elequont query builder
     * @param Integer $statuses Statuses
	 * @return Builder return the builder back
	 */
	public function scopeIncludeStatus($query, $statuses)
    {
    	if(!is_array($statuses))
            $statuses = [$statuses];

    	foreach($statuses as $status)
        {
    		$query = $query->whereRaw(config('status.column') . " & {$status} != 0");
    	}

        return $query;
    }

    /**
     * @param Builder $query Elequont query builder
     * @param Integer $statuses Statuses
     * @return Builder return the builder back
     */
	public function scopeExcludeStatus($query, $statuses)
    {
        if(!is_array($statuses))
            $statuses = [$statuses];

    	foreach($statuses as $status)
        {
    		$query = $query->whereRaw(config('status.column') . " & {$status} = 0");
    	}

        return $query;
    }
}


