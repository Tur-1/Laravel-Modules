<?php

namespace {namespace};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tur1\modules\Models\Model;
use {modulePath}\Observers\{Model}Observer;
use {modulePath}\Traits\{Model}ScopesTrait;
use {modulePath}\Traits\{Model}RelationshipsTrait;
use {modulePath}\Traits\{Model}AttributesTrait;
use {modulePath}\Filters\{class}Filter;

class {class} extends Model
{
    use HasFactory,
        {Model}ScopesTrait,
        {Model}AttributesTrait,
        {Model}RelationshipsTrait;

    protected $fillable = []; 
    
    protected $search = [];
    
    protected static function booted()
    { 
        static::observe({class}Observer::class);
    }

    public static function filters()
    {
        return [
            {class}Filter::class
        ];
    }
}
