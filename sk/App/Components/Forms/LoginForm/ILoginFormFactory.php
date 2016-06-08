<?php

namespace App\Components\Forms\LoginForm;

/**
 * Description of ILoginFormFactory
 *
 * @author miroslav.petras
 */
interface ILoginFormFactory {

    /** @return LoginForm */
    function create();
}
