<?php
/**
 * Created by PhpStorm.
 * User: rrafia
 * Date: 12/30/2014
 * Time: 2:04 PM
 */

namespace Protechmaster\Recaptcha\Facades;

use Illuminate\Support\Facades\Facade;


class RecaptchaFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'Recaptcha';
    }

}