<?php

namespace Tur1\Laravelmodules\Services;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class MakeModuleService
{

    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function makeModule($moduleName)
    {

        $basePath =  app_path("Modules/{$moduleName}");
        $message =  "Module ";

        if ($this->filesystem->exists($basePath)) {
            return [
                'error' => true,
                'message' => $message . "{$moduleName} already exists ",
            ];
        }




        $modules_stubs = [];
        $stubsBasePath = base_path('modules_stubs');

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($stubsBasePath));

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $relativePath = str_replace($stubsBasePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $modules_stubs[] = $relativePath;
            }
        }

        $singleModuleName = ucwords(Pluralizer::singular($moduleName));

        foreach ($modules_stubs as $relativePath) {

            $targetPath = $basePath . DIRECTORY_SEPARATOR . dirname($relativePath);

            $this->createFolder($targetPath);


            $stubFileName = basename($relativePath);

            $replacements = [
                'namespace' => "App\\Modules\\{$moduleName}\\" . str_replace('/', '\\', dirname($relativePath)),
                'modulePath' => "App\\Modules\\{$moduleName}",
                'pagePath' => "App\\Pages\\{$moduleName}",
                'pageNamespace' => "App\\Pages\\{$moduleName}\\" . str_replace('/', '\\', dirname($relativePath)),
                'class' => $singleModuleName,
                'Model' => $singleModuleName,
                'modelVariable' => Str::camel($singleModuleName),
                'table_name' => Str::snake(Str::plural($moduleName)),
                'routesName' => Str::snake(Str::plural($moduleName)),
                'fillableFields' => $fields ? $fillableString : '',
                'database_file_name' => date('Y_m_d_His') . '_' . Str::snake(Str::plural($moduleName)),
            ];
            $targetFilePath = $targetPath . DIRECTORY_SEPARATOR . str_replace(
                ['{class}', '{database_file_name}'],
                [$singleModuleName, $replacements['database_file_name']],
                $stubFileName
            );
            $this->createStubFile($stubsBasePath . DIRECTORY_SEPARATOR . $relativePath, $targetFilePath, $replacements);
        }

        return [
            'error' => false,
            'message' => $message . "{$moduleName} created successfully.",
        ];
    }
    public function makePage($moduleName)
    {


        $basePath = app_path("Pages/{$moduleName}");
        $message = "Page ";

        if ($this->filesystem->exists($basePath)) {
            return [
                'error' => true,
                'message' => $message . "{$moduleName} already exists ",
            ];
        } else {


            $modules_stubs = [];
            $stubsBasePath = base_path('pages_stubs');

            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($stubsBasePath));

            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $relativePath = str_replace($stubsBasePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $modules_stubs[] = $relativePath;
                }
            }

            $singleModuleName = ucwords(Pluralizer::singular($moduleName));

            foreach ($modules_stubs as $relativePath) {

                $targetPath = $basePath . DIRECTORY_SEPARATOR . dirname($relativePath);

                $this->createFolder($targetPath);


                $stubFileName = basename($relativePath);

                $replacements = [
                    'namespace' => "App\\Modules\\{$moduleName}\\" . str_replace('/', '\\', dirname($relativePath)),
                    'modulePath' => "App\\Modules\\{$moduleName}",
                    'pagePath' => "App\\Pages\\{$moduleName}",
                    'pageNamespace' => "App\\Pages\\{$moduleName}\\" . str_replace('/', '\\', dirname($relativePath)),
                    'class' => $singleModuleName,
                    'Model' => $singleModuleName,
                    'modelVariable' => Str::camel($singleModuleName),
                    'table_name' => Str::snake(Str::plural($moduleName)),
                    'routesName' => Str::snake(Str::plural($moduleName)),
                    'fillableFields' => $fields ? $fillableString : '',
                    'database_file_name' => date('Y_m_d_His') . '_' . Str::snake(Str::plural($moduleName)),
                ];
                $targetFilePath = $targetPath . DIRECTORY_SEPARATOR . str_replace(
                    ['{class}', '{database_file_name}'],
                    [$singleModuleName, $replacements['database_file_name']],
                    $stubFileName
                );
                $this->createStubFile($stubsBasePath . DIRECTORY_SEPARATOR . $relativePath, $targetFilePath, $replacements);
            }

            return [
                'error' => false,
                'message' => $message . "{$moduleName} created successfully.",
            ];
        }
    }
    private function createFolder($folderPath)
    {
        if (!$this->filesystem->isDirectory($folderPath)) {
            $this->filesystem->makeDirectory($folderPath, 0755, true);
        }
    }

    private function createStubFile($stubPath, $targetPath, $replacements = [])
    {

        $stubContent = $this->filesystem->get($stubPath);

        // Replace the placeholders in the stub content
        foreach ($replacements as $key => $value) {
            $stubContent = str_replace("{{$key}}", $value, $stubContent);
        }

        $this->filesystem->put($targetPath, $stubContent);
    }
}
