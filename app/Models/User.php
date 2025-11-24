<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The roles that belong to the user.
     */
    // public function roles(): BelongsToMany
    // {
    //     return $this->belongsToMany(Role::class)->withTimestamps();
    // }

    // /**
    //  * Check if the user has a specific role.
    //  *
    //  * @param string|array $role
    //  * @return bool
    //  */
    // public function hasRole($role): bool
    // {
    //     if (is_string($role)) {
    //         return $this->roles->contains('name', $role);
    //     }

    //     if (is_array($role)) {
    //         return (bool) $this->roles->whereIn('name', $role)->count();
    //     }

    //     return false;
    // }

    // /**
    //  * Check if the user has a specific permission.
    //  *
    //  * @param string|array $permission
    //  * @return bool
    //  */
    // public function hasPermission($permission): bool
    // {
    //     // Check direct permissions
    //     if ($this->permissions()->where('name', $permission)->exists()) {
    //         return true;
    //     }

    //     // Check permissions through roles
    //     return $this->roles->contains(function ($role) use ($permission) {
    //         return $role->permissions->contains('name', $permission);
    //     });
    // }

    // /**
    //  * Check if the user has any of the given permissions.
    //  *
    //  * @param array $permissions
    //  * @return bool
    //  */
    // public function hasAnyPermission(array $permissions): bool
    // {
    //     // Check direct permissions
    //     if ($this->permissions()->whereIn('name', $permissions)->exists()) {
    //         return true;
    //     }

    //     // Check permissions through roles
    //     return $this->roles->contains(function ($role) use ($permissions) {
    //         return $role->permissions->whereIn('name', $permissions)->isNotEmpty();
    //     });
    // }

    // /**
    //  * Check if the user has all of the given permissions.
    //  *
    //  * @param array $permissions
    //  * @return bool
    //  */
    // public function hasAllPermissions(array $permissions): bool
    // {
    //     $permissionCount = count($permissions);

    //     // Count direct permissions
    //     $directPermissionsCount = $this->permissions()
    //         ->whereIn('name', $permissions)
    //         ->count();

    //     // If we already have all permissions, return true
    //     if ($directPermissionsCount === $permissionCount) {
    //         return true;
    //     }

    //     // Get permissions from roles
    //     $rolePermissionsCount = $this->roles->flatMap(function ($role) {
    //         return $role->permissions->pluck('name');
    //     })->unique()->whereIn(null, $permissions)->count();

    //     return ($directPermissionsCount + $rolePermissionsCount) >= $permissionCount;
    // }

    // /**
    //  * Get all permissions for the user.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Collection
    //  */
    // public function getAllPermissions()
    // {
    //     return $this->permissions
    //         ->merge($this->getPermissionsViaRoles())
    //         ->unique('name');
    // }

    // /**
    //  * Get all permissions the user has via roles.
    //  *
    //  * @return \Illuminate\Support\Collection
    //  */
    // protected function getPermissionsViaRoles()
    // {
    //     return $this->loadMissing('roles', 'roles.permissions')
    //         ->roles->flatMap(function ($role) {
    //             return $role->permissions;
    //         })->unique('name');
    // }

    // /**
    //  * The permissions that belong to the user.
    //  */
    // public function permissions(): BelongsToMany
    // {
    //     return $this->belongsToMany(Permission::class, 'user_permissions')
    //         ->withTimestamps();
    // }

    // /**
    //  * Get the attributes that should be cast.
    //  *
    //  * @return array<string, string>
    //  */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
