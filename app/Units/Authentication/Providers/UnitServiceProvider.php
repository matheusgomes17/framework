<?php

namespace MVG\Units\Authentication\Providers;

use MVG\Support\Units\ServiceProvider;

/**
 * Class UnitServiceProvider
 *
 */
class UnitServiceProvider extends ServiceProvider
{
    /**
     * @var string Unit Alias for Translations and Views
     */
    protected $alias = 'auth';
    /**
     * @var bool Enable views loading on the Unity
     */
    protected $hasViews = false;
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