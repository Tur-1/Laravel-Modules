<?php
namespace {namespace};

use {modulePath}\Database\factories\{Model}Factory;
use Illuminate\Database\Seeder;
 
class {Model}Seeder extends Seeder
{
    public function run()
    {
        {Model}Factory::new()->count(30)->create();
    }
}