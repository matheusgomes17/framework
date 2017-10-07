<?php

namespace MVG\Domains\Categories\Providers;

use MVG\Domains\Categories\Contracts\Repositories\CategoryRepositoryContract;
use MVG\Domains\Categories\Database\Factories\CategoryFactory;
use MVG\Domains\Categories\Database\Seeders\CategorySeeder;
use MVG\Domains\Categories\Repositories\CategoryRepository;
use MVG\Domains\Categories\Database\Migrations;
use MVG\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider
 * @package MVG\Domains\Categories\Providers
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'category';
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
        CategoryRepositoryContract::class => CategoryRepository::class
    ];
    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        Migrations\CreateCategoriesTable::class,
    ];
    /**
     * @var array Some Seeders
     */
    protected $seeders = [
        CategorySeeder::class,
    ];
    /**
     * @var array Model factories
     */
    protected $factories = [
        CategoryFactory::class,
    ];
}