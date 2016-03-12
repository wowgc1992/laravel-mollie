<?php

namespace PeterIcebear\Tests\Mollie;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use PeterIcebear\Mollie\Facades\Mollie;
use PeterIcebear\Mollie\MollieApiClientManager;

class FacadeTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'mollie';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Mollie::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return MollieApiClientManager::class;
    }
}
