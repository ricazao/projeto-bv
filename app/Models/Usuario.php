<?php

namespace App\Models;

use App\Models\Traits\Pid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use Pid,
        SoftDeletes;

    protected $table = 'usuarios';

    protected $guarded = ['id', 'pid'];

    public $timestamps = true;

    public $userstamps = true;
}
