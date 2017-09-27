<?php

namespace MVG\Units\Core\Providers;

use MVG\Support\Units\ServiceProvider;

/**
 * Class UnitServiceProvider
 * @package MVG\Units\Core\Providers
 */
class UnitServiceProvider extends ServiceProvider
{
    /**
     * @var string Unit Alias for Translations and Views
     */
    protected $alias = 'core';
    /**
     * @var bool Enable views loading on the Unity
     */
    protected $hasViews = true;
    /**
     * @var bool Enable translations loading on the Unity
     */
    protected $hasTranslations = true;
    /**
     * @var array List of Unit Service Providers to Register
     */
    protected $providers = [
        RouteServiceProvider::class,
    ];
}