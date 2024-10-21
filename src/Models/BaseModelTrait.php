<?php

namespace Tur1\Laravelmodules\Models;

trait BaseModelTrait
{
    public function scopeWithFilters($query)
    {
        foreach (static::filters() as $filterClass) {

            $filterName = class_basename($filterClass);
            $query->withGlobalScope($filterName, new $filterClass);
        }

        return $query->search();
    }
    protected function scopeSearch($query)
    {

        if (request()->filled('search')) {

            $searchValue = request('search');
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
