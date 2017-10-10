<?php

namespace MVG\Domains\Authentication\Models\Traits\Scope;

use Illuminate\Database\Eloquent\Model;
use MVG\Domains\Authentication\Scopes\TenantScope;
use MVG\Support\Foundation\Auth\TenantManager;

/**
 * Class TenantModels
 *
 */
trait TenantModels
{

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());

        static::creating(function (Model $model) {
            /** @var TenantManager $tenantManager */
            $tenantManager = app(TenantManager::class);

            if ($tenantManager->getTenant()) {
                $tenantId = $tenantManager->getTenant()->id;
                $model->tenant_id = $tenantId;
            }
        });
    }
}