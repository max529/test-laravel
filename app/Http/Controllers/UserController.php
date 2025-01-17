<?php

namespace App\Http\Controllers;

use App\Models\User;

/**
 * Summary of UtilisateurController
 * @extends ResourceController<User>
 */
class UserController extends ResourceController
{

    /**
     * @inheritDoc
     */
    protected function beforeSend($item)
    {
        return $item;
    }

    /**
     * @inheritDoc
     */
    protected function defineModel()
    {
        return User::class;
    }
}