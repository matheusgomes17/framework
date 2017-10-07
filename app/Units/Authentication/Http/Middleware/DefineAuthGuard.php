<?php

namespace MVG\Units\Authentication\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use MVG\Support\Foundation\Auth\TenantManager;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class DefineAuthGuard
 * @package MVG\Units\Authentication\Http\Middleware
 */
class DefineAuthGuard
{
    /**
     * @param $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        /** @var TenantManager $tenantManager */
        $tenantManager = app(TenantManager::class);

        if(!$tenantManager->getTenant() && !$tenantManager->isSubdomainExcept()){
            abort(404);
        }

        if(!$tenantManager->isSubdomainExcept()){
            config([
                'auth.defaults.guard' => 'web_tenants',
                'auth.defaults.passwords' => 'user_accounts'
            ]);
        }

        return $next($request);
    }
}