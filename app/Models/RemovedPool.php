<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class RemovedPool extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'removed_pools';
    public $timestamps = false;

    protected $guarded = [];
}
