<?php

namespace MVG\Domains\Authentication\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use MVG\Support\Foundation\Auth\TenantManager;

class TenantScope implements Scope
{
    /**
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        /** @var TenantManager $tenantManager */
        $tenantManager = app(TenantManager::class);

        if ($tenantManager->getTenant()) {
            $tenantId = $tenantManager->getTenant()->id;
            $builder->where('tenant_id', $tenantId);
        }
    }
}