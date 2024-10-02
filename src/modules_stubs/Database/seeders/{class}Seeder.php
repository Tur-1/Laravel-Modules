<?php
namespace {namespace};

use {modulePath}\Models\{Model};
use Illuminate\Database\Seeder;
 
class {Model}Seeder extends Seeder
{
    public function run()
    {
        {Model}::factory(60)->create();
    }
}