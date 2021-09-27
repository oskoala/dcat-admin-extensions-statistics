<?php

namespace OsKoala\Statistics\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasDateTimeFormatter;

    protected $guarded = [];
}
