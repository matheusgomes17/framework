<?php

namespace MVG\Support\Foundation\Auth\Contracts;

/**
 * Interface TenantContract
 *
 */
interface TenantContract
{
    /**
     * @return mixed
     */
    public function routeParam();

    /**
     * @return bool
     */
    public function isSubdomainExcept();

    /**
     * @return mixed
     */
    public function getTenant();
}