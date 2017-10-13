<?php

namespace Baytek\Laravel\StatusBit;

use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $fillable = ['type_id', 'type', 'status', 'comment'];

    public function __construct(array $attributes = [])
    {
    	// Set the table used for the status histories
    	$this->setTable(config('status.history_table'));

    	parent::__construct($attributes);
    }

    public function scopeGetHistory($query, $model)
    {
    	$class = class_basename(get_class($model));

    	return $query
    		->where('type_id', $model->id)
    		->where('type', $class);
    }

    public function scopeGetCurrent($query, $model)
    {
    	$class = class_basename(get_class($model));

    	return $query
    		->where('type_id', $model->id)
    		->where('type', $class)
    		->whereRaw("(status & {$model->status}) != 0");
    }

    // History where model has supplied status bit set
    public function scopeGetWithStatus($query, $model, $status)
    {
        $class = class_basename(get_class($model));

        return $query
            ->where('type_id', $model->id)
            ->where('type', $class)
            ->whereRaw("(status & {$status}) != 0");
    }

}
