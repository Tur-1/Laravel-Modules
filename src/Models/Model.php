<?php

namespace Tur1\modules\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Tur1\modules\Models\BaseModelTrait;

abstract class Model extends BaseModel
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
