<?php

namespace MVG\Domains\Authentication\Providers;

use MVG\Domains\Authentication\Contracts\Repositories\RegisterRepositoryContract;
use MVG\Domains\Authentication\Repositories\RegisterRepository;
use MVG\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider
 * @package MVG\Domains\Authentication\Providers
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var array Bind contracts to implementations
     */
    protected $bindings = [
        RegisterRepositoryContract::class, RegisterRepository::class
    ];
}