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

trait Statusable {
    /**
     * @param Builder $query Elequont query builder
     * @param Integer $statuses Statuses
     * @return Builder return the builder back
     *
     * Possible statuses arguments -- I've now tested and all these are possible
     *  $statuses = 2; //If the array is not indexed with include or exclude keys, assume include
     *  $statuses = [2, 4];
     *  $statuses = ['exclude' => [2, 4]];
     *  $statuses = ['include' => [2, 4]];
     *  $statuses = ['include' => [
     *      Customer::FEATURED,
     *      Customer::ARCHIVED
     *  ],
     *  'exclude' => [
     *      Customer::DISABLED,
     *      Customer::DELETED
     *  ]];
     */
    public function scopeStatus($query, $statuses)
    {
        $operation = '!='; // Default we include only

        // Check if the arguments have been passed straight up
        if(count(func_get_args()) > 2) {
            $statuses = func_get_args();
            array_shift($statuses);
        }

        foreach((array)$statuses as $key => $status)
        {
            // Only keep the keys we find relevant
            if(is_array($status))
            {
                // Sum the bits
                $status = array_sum($status);

                // Change the operator when exclusion
                if($key == 'exclude')
                {
                    $operation = '=';
                }
            }

            // SQL equation string
            $equation = config('status.column', 'status') . " & $status";

            // Query Builder
            $query = $query->whereRaw($equation . $operation . 0);
        }

        return $query;
    }

    /**
     * Check if the current model has a status set. Does a bitwise check with the status value supplied.
     * @param  int      $status   The status to check for. Up to 2^32
     * @return boolean            Whether the status is set or not.
     */
    public function hasStatus($status)
    {
        return ($this->status & $status) == $status;
    }

}
