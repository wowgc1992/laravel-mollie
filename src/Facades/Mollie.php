<?php

namespace PeterIcebear\Mollie\Facades;

class Mollie extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'mollie';
    }
}
