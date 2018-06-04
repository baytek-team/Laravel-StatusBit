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

use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $fillable = [
        'type_id',
        'type',
        'status',
        'state',
        'comment'
    ];

    public function __construct(array $attributes = [])
    {
    	// Set the table used for the status histories
    	$this->setTable(config('status.history_table'));

    	parent::__construct($attributes);
    }

    /**
     * Scope to get the status histories
     * @param  builder $query  Laravel query
     * @param  model   $model  The model that we wish to get status for
     * @return builder         Scope of the current status histories
     */
    public function scopeGetHistory($query, $model)
    {
    	$class = class_basename(get_class($model));

    	return $query
    		->where('type_id', $model->id)
    		->where('type', $class);
    }

    /**
     * Scope to get the current status history
     * @param  builder $query  Laravel query
     * @param  model   $model The model that we wish to get status for
     * @return builder        Scope of the current status histories
     */
    public function scopeGetCurrent($query, $model)
    {
    	$class = class_basename(get_class($model));

    	return $query
    		->where('type_id', $model->id)
    		->where('type', $class)
    		->whereRaw("(status & {$model->status}) != 0");
    }

    /**
     * History where model has supplied status bit set
     * @param  builder $query   Laravel query
     * @param  model   $model   The model that we wish to get status for
     * @param  int     $status  Status value that we wish to find
     * @return builder          Scope of the status history of a status value
     */
    public function scopeGetWithStatus($query, $model, $status)
    {
        $class = class_basename(get_class($model));

        return $query
            ->where('type_id', $model->id)
            ->where('type', $class)
            ->whereRaw("(status & {$status}) != 0");
    }

}
