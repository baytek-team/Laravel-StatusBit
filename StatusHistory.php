<?php

namespace Baytek\LaravelStatusBit;

use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $fillable = ['type_id', 'type', 'status'];

    public function __construct(array $attributes = [])
    {
    	// Set the table used for the status histories
    	$this->setTable(config('status.history_table'));

    	parent::__construct($attributes);
    }

}
