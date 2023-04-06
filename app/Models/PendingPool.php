<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PendingPool extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'pending_pools';
    public $timestamps = false;

    protected $guarded = [];
}
