<?php

namespace Tests\Feature\Api;

use App\User;

trait Authorized
{
    protected function getAuthorizedHeaders()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        return ['Authorization' => "Bearer $token"];
    }
}
