<?php

namespace MVG\Support\Foundation\Auth;

use MVG\Support\Foundation\Auth\Contracts\TenantContract;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TenantManager
 * @package MVG\Support\Foundation\Auth
 */
class TenantManager implements TenantContract
{
    private $tenant;

    /**
     * @return mixed
     */
    public function routeParam()
    {
        return Request::route(config('auth.tenants.route_param'));
    }

    /**
     * @return bool
     */
    public function isSubdomainExcept()
    {
        $tenantParam = $this->routeParam();

        return $tenantParam && in_array($tenantParam, config('auth.tenants.subdomains_except'))
            ? true : false;
    }

    /**
     * @return mixed
     */
    public function getTenant()
    {
        if (!$this->tenant) {
            $model = config('auth.models.tenant');
            $this->tenant = $model
                ::where(config('auth.tenants.field_name'), $this->routeParam())
                ->first();
        }

        return $this->tenant;
    }
}