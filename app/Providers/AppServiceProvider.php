<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define the modules directory
        $modulesPath = base_path('app\Modules'); // Correct path for Linux & Windows

        // Check if the modules directory exists
        if (!File::exists($modulesPath)) {
            return;
        }

        // Get the list of module directories
        $modules = collect(File::directories($modulesPath))->mapWithKeys(function ($path) {
            $moduleName = ucfirst(basename($path)); // Get the module name
            return [$moduleName => $path]; // Return the module name and path
        });

        // Share module availability with all views
        view()->share('modules', $modules->keys()->toArray());

        // Register modules
        foreach ($modules as $module => $modulePath) {
            $this->registerModule($module, $modulePath);
        }
    }

    private function registerModule(string $module, string $modulePath): void
    {
        $routesPath = "{$modulePath}\Routes";
        $viewsPath = "{$modulePath}\Resources\Views";
        $migrationsPath = "{$modulePath}\Database\Migrations";

        // Load Web Routes
        if (File::exists("{$routesPath}/web.php")) {
            Route::middleware('web')->group(function () use ($routesPath) {
                require "{$routesPath}/web.php";
            });
        }

        // Load API Routes
        if (File::exists("{$routesPath}/api.php")) {
            Route::middleware('api')->prefix('api')->group(function () use ($routesPath) {
                require "{$routesPath}/api.php";
            });
        }

        // Add View Namespace
        if (is_dir($viewsPath)) { // Check if directory exists
            View::addNamespace($module, $viewsPath);
        }

        // Load Migrations
        if (is_dir($migrationsPath)) { // Check if directory exists
            $this->loadMigrationsFrom($migrationsPath);
        }
    }

}
