<?php

namespace App\Models;

use App\Models\Traits\HasUserstamps;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    use HasUserstamps;

    public const CREATED_AT = 'criado_em';

    public const CREATED_BY = 'criado_por';

    public const UPDATED_AT = 'alterado_em';

    public const UPDATED_BY = 'alterado_por';

    public const DELETED_AT = 'excluido_em';

    public const DELETED_BY = 'excluido_por';

    public $timestamps = false;

    public $userstamps = false;
}
