<?php

namespace MVG\Domains\ActivityLog\Providers;

use MVG\Domains\ActivityLog\Database\Migrations\CreateActivityLogTable;
use MVG\Support\Domain\ServiceProvider;

/**
 * Class DomainServiceProvider
 *
 */
class DomainServiceProvider extends ServiceProvider
{
    /**
     * @var string Domain "alias"
     */
    protected $alias = 'activitylog';
    /**
     * @var array Migrations of this domains
     */
    protected $migrations = [
        CreateActivityLogTable::class,
    ];
}