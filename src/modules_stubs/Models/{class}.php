<?php

namespace {namespace};

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tur1\Laravelmodules\Models\BaseModel;
use {modulePath}\Observers\{Model}Observer;
use {modulePath}\Traits\{Model}ScopesTrait;
use {modulePath}\Traits\{Model}RelationshipsTrait;
use {modulePath}\Traits\{Model}AttributesTrait;
use {modulePath}\Database\factories\{Model}Factory;

class {class} extends BaseModel
{
    use HasFactory,
        {Model}ScopesTrait,
        {Model}AttributesTrait,
        {Model}RelationshipsTrait;

    protected $fillable = []; 
    
    protected $search = [];
    
    protected static function booted()
    {
        parent::booted();
        static::observe({class}Observer::class);
    }

    public static function filters()
    {
        return [];
    }
      /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return {Model}Factory::new();
    }
}
