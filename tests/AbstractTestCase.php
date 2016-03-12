<?php

namespace PeterIcebear\Tests\Mollie;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use PeterIcebear\Mollie\Providers\MollieServiceProvider;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return MollieServiceProvider::class;
    }
}
