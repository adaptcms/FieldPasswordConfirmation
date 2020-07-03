<?php

namespace Adaptcms\FieldPasswordConfirmation\Facades;

use Illuminate\Support\Facades\Facade;

class FieldPasswordConfirmation extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'FieldPasswordConfirmation';
    }
}
