<?php

namespace Tur1\modules\Models;

use Illuminate\Foundation\Auth\User;

class Authenticatable extends User
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
