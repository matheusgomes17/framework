<?php

namespace MVG\Support\Http\Routing;

use Illuminate\Routing\Redirector as RedirectorLaravel;
use MVG\Support\Foundation\Auth\TenantManager;

/**
 * Class Redirector
 *
 */
class Redirector extends RedirectorLaravel
{
    /**
     * @param $name
     * @param array $params
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\RedirectResponse
     */
    public function routeTenant($name, $params = [], $status = 302, $headers = [])
    {
        $tenantManager = app(TenantManager::class);
        $tenantParam = $tenantManager->routeParam();

        return $this->route($name, $params + [
                config('auth.tenants.route_param') => $tenantParam
            ], $status, $headers);
    }
}