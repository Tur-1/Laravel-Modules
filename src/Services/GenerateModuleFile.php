<?php

namespace Tur1\Laravelmodules\Services;

use Illuminate\Support\Facades\File;

class GenerateModuleFile
{
    public static function generate($stubFileName, $moduleName, $targetFileName)
    {

        if (empty($moduleName)) {
            throw new \Exception("The --module option (module) is required.", 1);
        }

        $stubPath = __DIR__ . './../stubs/' . $stubFileName . '.stub';
        if (!File::exists($stubPath)) {
            throw new \Exception("Stub file does not exist at: {$stubPath}", 1);
        }
        $targetPath = base_path("app/Modules/{$moduleName}/Controllers/{$targetFileName}.php");


        $stubContent = File::get($stubPath);
        $namespace = "App\\Modules\\{$moduleName}\\Controllers";
        $stubContent = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $targetFileName],
            $stubContent
        );

        $directory = dirname($targetPath);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put($targetPath, $stubContent);


        return $namespace;
    }
}
