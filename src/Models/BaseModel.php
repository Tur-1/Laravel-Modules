<?php

namespace Tur1\Laravelmodules\Models;

use Illuminate\Database\Eloquent\Model;
use Tur1\Laravelmodules\Models\BaseModelTrait;

abstract class BaseModel extends Model
{
    use BaseModelTrait;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    protected $search = [];

    protected static function filters()
    {
        return [];
    }
}
