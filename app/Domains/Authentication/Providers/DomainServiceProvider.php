<?php

namespace MVG\Domains\Authentication\Providers;

use MVG\Domains\Authentication\Contracts\Repositories\PermissionRepositoryContract;
use MVG\Domains\Authentication\Contracts\Repositories\RoleRepositoryContract;
use MVG\Domains\Authentication\Database\Factories\TenantFactory;
use MVG\Domains\Authentication\Database\Migrations;
use MVG\Domains\Authentication\Database\Seeders;
use MVG\Domains\Authentication\Repositories\PermissionRepository;
use MVG\Domains\Authentication\Repositories\RoleRepository;
use MVG\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider
 * @package MVG\Domains\Authentication\Providers
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'auth';

    /**
     * @var array Providers registered within the domain
     */
    protected $subProviders = [
        EventServiceProvider::class,
    ];

    /**
     * @var array Bind contracts to implementations
     */
    protected $bindings = [
        PermissionRepositoryContract::class => PermissionRepository::class,
        RoleRepositoryContract::class => RoleRepository::class
    ];

    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        Migrations\CreateTenantsTable::class,
        Migrations\CreatePermissionsTable::class,
        Migrations\CreateRolesTable::class,
        Migrations\CreateModelHasPermissionsTable::class,
        Migrations\CreateModelHasRolesTable::class,
        Migrations\CreateRoleHasPermissionsTable::class,
    ];

    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        Seeders\TenantsTableSeeder::class,
        Seeders\PermissionRoleTableSeeder::class,
        Seeders\UserRoleTableSeeder::class,
    ];

    /**
     * @var array Model factories
     */
    protected $factories = [
        TenantFactory::class
    ];
}