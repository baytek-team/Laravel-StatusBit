<?php

namespace Baytek\LaravelStatusBit;

use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $fillable = ['type_id', 'type', 'status'];
}
