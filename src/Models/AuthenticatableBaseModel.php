<?php

namespace Tur1\Laravelmodules\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Builder;
use Tur1\Laravelmodules\Models\BaseModelTrait;

class AuthenticatableBaseModel extends User
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
