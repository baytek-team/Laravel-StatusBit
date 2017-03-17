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

// use StatusCollection;

trait Statusable
{
    public $statusComment = '';

    public static $statuses = [
        0              => 'No Status',
        self::ARCHIVED => 'Archived',
        self::DISABLED => 'Disabled',
        self::DELETED  => 'Deleted',
        self::REMOVED  => 'Removed',
        self::DRAFT    => 'Draft',
        self::FEATURED => 'Featured',
    ];

    public function __construct($attributes = [])
    {
        if(property_exists($this, 'statuses')) {
            $this::$statuses = collect(static::$statuses);
        }
        else {
            $this::$statuses = collect(parent::$statuses)
                ->union(collect(static::$statuses));
        }

        parent::__construct($attributes);
    }

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
    // public function scopeWithStatus($query, $statuses)
    // {
    //     $operation = '!='; // Default we include only

    //     // Check if the arguments have been passed straight up
    //     if(count(func_get_args()) > 2) {
    //         $statuses = func_get_args();
    //         array_shift($statuses);
    //     }

    //     foreach((array)$statuses as $key => $status)
    //     {
    //         // Only keep the keys we find relevant
    //         if(is_array($status))
    //         {
    //             // Sum the bits
    //             $status = array_sum($status);

    //             // Change the operator when exclusion
    //             if($key == 'exclude')
    //             {
    //                 $operation = '=';
    //             }
    //         }

    //         // SQL equation string
    //         $equation = config('status.column', 'status') . " & $status";

    //         // Query Builder
    //         $query = $query->whereRaw($equation . $operation . 0);
    //     }

    //     return $query;
    // }

    public function scopeWithStatus($query, $table, ...$statuses)
    {
        $operation = '!='; // Default we include only

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

            if($table) {
                $equation = env('DB_PREFIX') . $table.'.'.$equation;
            }

            // Query Builder
            $query = $query->whereRaw($equation . $operation . 0);
        }

        return $query;
    }

    public function onBit($status)
    {
        $column = config('status.column', 'status');
        $this->$column |= $status;
        return $this;
    }

    public function offBit($status)
    {
        $column = config('status.column', 'status');
        $this->$column &= ~$status;
        return $this;
    }

    public function statuses($filter = null)
    {
        $response = new StatusCollection;
        $statuses = static::$statuses;

        if(!is_null($filter)) {
            $statuses = $statuses->only($filter);
        }

        $statuses->each(function ($value, $status) use ($response) {
            if($this->hasStatus($status)) {
                $response->put($status, $value);
            }
        });

        return $response;
    }

    /**
     * Check if the current model has a status set. Does a bitwise check with the status value supplied.
     * @param  int      $status   The status to check for. Up to 2^32
     * @return boolean            Whether the status is set or not.
     */
    public function hasStatus($status)
    {
        $column = config('status.column', 'status');

        // Just make sure we return true or false incase someone tries to do ===
        return (bool)($this->$column & $status);
    }

    /**
     * Checks the status history and returns a collection of StatusHistory objects where the supplied status bit has been on.
     * @param  int         $status   The status to check for. Up to 2^32
     * @return Collection            Collection of StatusHistory objects.
     */
    public function getHistoryOfStatus($status)
    {
        $column = config('status.column', 'status');

        // Return collection of mathing StatusHistory objects
        return (new StatusHistory)->getWithStatus($this, $status)->get();
    }

}
