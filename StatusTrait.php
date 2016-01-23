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
	/**
     * @param Builder $query Elequont query builder
     * @param Integer $statuses Statuses
	 * @return Builder return the builder back
	 */
    // Possible statuses argument
    // $statuses = 2; //If the array is not indexed with include or exclude keys, assume include
    // $statuses = [2, 4];
    // $statuses = ['exclude' => [2, 4]];
    // $statuses = ['include' => [2, 4]];

    //Should be renamed to scopeWithStatus
	public function scopeStatus($query, $statuses)
    {
        if(!is_array($statuses)) {
            $statuses = [$statuses];
        }

    	foreach($statuses as $status)
        {
            $equation = config('status.column', 'status') . " & $status";
            $operation = '!=';

    		$query = $query->where($equation, $operation, 0);
    	}

        return $query;
    }

    /**
     * @param Builder $query Elequont query builder
     * @param Integer $statuses Statuses
     * @return Builder return the builder back
     */
    // Interesting status array
    // $statuses = ['on' => [2, 4]];
    // $statuses = ['off' => [2, 4]];
    // $statuses = ['flip' => [2, 4]];

    // Method should be renamed to setStatus
	public function scopeExcludeStatus($query, $statuses)
    {
        if(!is_array($statuses))
            $statuses = [$statuses];

    	foreach($statuses as $status)
        {
    		$query = $query->whereRaw(config('status.column', 'status') . " & {$status} = 0");
    	}

        return $query;
    }
}


