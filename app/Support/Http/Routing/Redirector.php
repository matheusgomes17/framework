<?php

namespace MVG\Support\Http\Routing;

use Illuminate\Routing\Redirector as RedirectorLaravel;
use MVG\Support\Foundation\Auth\TenantManager;

class Redirector extends RedirectorLaravel
{
    public function routeTenant($name, $params = [], $status = 302, $headers = [])
    {
        $tenantManager = app(TenantManager::class);
        $tenantParam = $tenantManager->routeParam();

        return $this->route($name, $params + [
                config('auth.tenants.route_param') => $tenantParam
            ], $status, $headers);
    }
}