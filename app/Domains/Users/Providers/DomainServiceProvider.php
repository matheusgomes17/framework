<?php

namespace MVG\Domains\Users\Providers;

use MVG\Domains\Users\Contracts\Repositories\UserRepository as UserRepositoryContract;
use MVG\Domains\Users\Database\Factories\UserFactory;
use MVG\Domains\Users\Database\Migrations\CreatePasswordResetsTable;
use MVG\Domains\Users\Database\Migrations\CreateUsersTable;
use MVG\Domains\Users\Database\Seeders\UsersSeeder;
use MVG\Support\Domain\ServiceProvider;
use MVG\Domains\Users\Repositories\UserRepository;

/**
 * Class DomainServiceProvider
 * @package MVG\Domains\Users\Providers
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'users';
    /**
     * @var bool Enable translations
     */
    protected $hasTranslations = true;
    /**
     * @var array Providers registered within the domain
     */
    protected $subProviders = [
        //EventServiceProvider::class,
    ];
    /**
     * @var array Bind contracts to implementations
     */
    protected $bindings = [
        UserRepositoryContract::class, UserRepository::class
    ];
    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        CreateUsersTable::class,
        CreatePasswordResetsTable::class,
    ];
    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        UsersSeeder::class,
    ];
    /**
     * @var array Model factories
     */
    protected $factories = [
        UserFactory::class,
    ];
}