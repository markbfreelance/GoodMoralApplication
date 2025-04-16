<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RoleCheck
{
    /**
     * Check if the authenticated user has one of the required roles.
     *
     * @param array|string $roles
     * @return void
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function checkRole($roles)
    {
        // If $roles is a string, convert it to an array
        if (is_string($roles)) {
            $roles = [$roles];
        }

        // Check if the authenticated user has one of the allowed roles
        if (Auth::check() && !in_array(Auth::user()->account_type, $roles)) {
            abort(403, 'Unauthorized access.');
        }
    }
}
