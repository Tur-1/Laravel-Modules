<?php

namespace Tur1\Laravelmodules\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class AuthenticatableBaseModel extends User
{
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

    protected static function booted()
    {
        foreach (static::filters() as $name) {
            static::addGlobalScope(new $name);
        }
        static::addGlobalScope('search', function (Builder $builder) {
            $builder->search();
        });
    }
    protected function scopeSearch($query, $searchValue = null)
    {

        $searchValue = $searchValue ?? request('search');

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                foreach ($this->search as $field) {
                    if ($this->isRelationship($field)) {
                        [$relation, $relationField] = explode('.', $field);
                        $query->orWhereHas($relation, function ($query) use ($relationField, $searchValue) {
                            $query->where($relationField, 'like', '%' . $searchValue . '%');
                        });
                    } else {
                        $query->orWhere($field, 'like', '%' . $searchValue . '%');
                    }
                }
            });
        }

        return $query;
    }
    private function isRelationship($field)
    {
        return str_contains($field, '.');
    }
}
