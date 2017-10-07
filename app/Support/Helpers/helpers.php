<?php

/**
 * Global helpers file with misc functions.
 */

use MVG\Support\Foundation\Auth\TenantManager;

if (!function_exists('app_name')) {
    /**
     * Helpers to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (!function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (!function_exists('includeRouteFiles')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('routeTenant')) {
    /**
     * @param $name
     * @param array $params
     * @param bool|true $absolute
     * @return string
     */
    function routeTenant($name, $params = [], $absolute = true)
    {
        $tenantManager = app(TenantManager::class);
        $tenantParam = $tenantManager->routeParam();

        return route($name, $params + [
                config('auth.tenants.route_param') => $tenantParam
            ], $absolute);
    }
}
if (!function_exists('layoutTenant')) {
    /**
     * @return string
     */
    function layoutTenant()
    {
        $tenantManager = app(TenantManager::class);
        $isSubdomainExcept = $tenantManager->isSubdomainExcept();

        return !$isSubdomainExcept ? 'layouts.app' : 'layouts.admin';
    }
}