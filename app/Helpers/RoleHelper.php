<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class RoleHelper
{
    const ROLES = [
        'admin' => 'Admin',
        'sub_admin' => 'Sub-Admin',
        'user' => 'User',
    ];

    /**
     * Get all available roles as an array.
     *
     * @return array
     */
    public static function getRoles(): array
    {
        return self::ROLES;
    }

    /**
     * Get a role label by key.
     *
     * @param string $key
     * @return string|null
     */
    public static function getRoleLabel(string $key): ?string
    {
        return self::ROLES[$key] ?? null;
    }

    /**
     * Check if the current user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public static function hasRole(string $role): bool
    {
        return Auth::check() && Auth::user()->role === $role;
    }

    /**
     * Get the current user's role.
     *
     * @return string|null
     */
    public static function currentUserRole(): ?string
    {
        return Auth::check() ? Auth::user()->role : null;
    }
}
