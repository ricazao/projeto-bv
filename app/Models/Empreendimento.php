<?php

namespace App\Models;

use App\Models\Traits\Pid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empreendimento extends Model
{
    use Pid,
        SoftDeletes;

    protected $table = 'empreendimentos';

    protected $guarded = ['id', 'pid'];

    public $timestamps = true;

    public $userstamps = true;

    public function casts(): array
    {
        return [
            'processado' => 'boolean',
        ];
    }
}
