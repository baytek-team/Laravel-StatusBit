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
	public function scopeIncludeStatus($query, $statuses)
    {
    	if(!is_array($statuses)) $statuses = [$statuses];

    	foreach($statuses as $status) {
    		$query = $query->whereRaw("status & {$status} != 0");
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
        if(!is_array($statuses)) $statuses = [$statuses];

    	foreach($statuses as $status) {
    		$query = $query->whereRaw("status & {$status} = 0");
    	}
        return $query;
    }
}


