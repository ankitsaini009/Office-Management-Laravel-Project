<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Redirect to the admin login page if the user is not authenticated
        return $request->expectsJson() ? null : route('admin.login');
    }

    /**
     * Authenticate the admin user.
     */
    protected function authenticate($request, array $guards): void
    {
        // Check if the user is authenticated with the 'admin' guard
        if ($this->auth->guard('admin')->check()) {
            $this->auth->shouldUse('admin'); // Set the current guard to 'admin'
            return; // Allow the request to proceed
        }

        // If not authenticated, throw an unauthenticated exception
        $this->unauthenticated($request, ['admin']);
    }
}
