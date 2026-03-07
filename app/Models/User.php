<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity;

    protected $primaryKey = 'userID';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'username',
        'phone',
        'password',
        'userImage',
        'google_id',
        'avatar',
        'admin_role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class, 'userID');
    }

    public function appointments()
    {
        return $this->hasManyThrough(
            Appointment::class,
            Pet::class,
            'userID', // Foreign key on pets table
            'petID',  // Foreign key on appointments table
            'userID', // Local key on users table
            'petID'   // Local key on pets table
        );
    }

    public function boardingReservations()
    {
        return $this->hasManyThrough(
            Boarding::class,
            Pet::class,
            'userID', // Foreign key on pets table
            'petID',  // Foreign key on boardings table
            'userID', // Local key on users table
            'petID'   // Local key on pets table
        );
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check whether this admin user has a specific permission.
     *
     * Permission key format: "section.action"  e.g. "users.view", "services.delete".
     * null admin_role is treated as super_admin (backward-compatible with existing admins).
     *
     * Role matrix
     * ┌─────────────┬──────────────────────────────────────────────────────┐
     * │ super_admin │ All permissions                                      │
     * │ manager     │ Full ops — no users, no settings, no DB restore      │
     * │ staff       │ Create/edit appointments, boardings, pets, payments  │
     * │             │ No deletes, no service management, no reports        │
     * │ viewer      │ Read-only across all accessible sections             │
     * └─────────────┴──────────────────────────────────────────────────────┘
     */
    public function hasPermission(string $permission): bool
    {
        if (!$this->isAdmin()) {
            return false;
        }

        $role = $this->admin_role ?? 'super_admin';

        if ($role === 'super_admin') {
            return true;
        }

        $permissionMap = [
            'manager' => [
                'dashboard.view',
                'pets.view', 'pets.create', 'pets.edit', 'pets.delete',
                'appointments.view', 'appointments.create', 'appointments.edit',
                'appointments.cancel', 'appointments.delete',
                'boardings.view', 'boardings.create', 'boardings.edit',
                'boardings.cancel', 'boardings.delete',
                'services.view', 'services.create', 'services.edit', 'services.toggle',
                'payments.view', 'payments.create', 'payments.edit', 'payments.refund',
                'reports.view',
                'account.view', 'account.edit',
            ],
            'staff' => [
                'dashboard.view',
                'pets.view', 'pets.create', 'pets.edit',
                'appointments.view', 'appointments.create', 'appointments.edit', 'appointments.cancel',
                'boardings.view', 'boardings.create', 'boardings.edit', 'boardings.cancel',
                'services.view',
                'payments.view', 'payments.create',
                'account.view', 'account.edit',
            ],
            'viewer' => [
                'dashboard.view',
                'pets.view',
                'appointments.view',
                'boardings.view',
                'services.view',
                'payments.view',
                'account.view',
            ],
        ];

        return in_array($permission, $permissionMap[$role] ?? []);
    }

    /**
     * Human-readable label for the admin role.
     */
    public function getAdminRoleLabelAttribute(): string
    {
        return match ($this->admin_role ?? 'super_admin') {
            'super_admin' => 'Super Admin',
            'manager'     => 'Manager',
            'staff'       => 'Staff',
            'viewer'      => 'Viewer',
            default       => 'Admin',
        };
    }

    /**
     * Tailwind color classes for the role badge.
     */
    public function getAdminRoleColorAttribute(): string
    {
        return match ($this->admin_role ?? 'super_admin') {
            'super_admin' => 'tw-bg-purple-900 tw-text-purple-300',
            'manager'     => 'tw-bg-blue-900 tw-text-blue-300',
            'staff'       => 'tw-bg-green-900 tw-text-green-300',
            'viewer'      => 'tw-bg-gray-600 tw-text-gray-300',
            default       => 'tw-bg-gray-600 tw-text-gray-300',
        };
    }

    public function getProfileImageUrlAttribute(): string
    {
        $imagePath = $this->userImage;

        if (!empty($imagePath) && filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        if (!empty($imagePath)) {
            return asset('storage/' . ltrim(preg_replace('/^storage\//i', '', $imagePath), '/'));
        }

        if (!empty($this->avatar) && filter_var($this->avatar, FILTER_VALIDATE_URL)) {
            return $this->avatar;
        }

        return asset('storage/userImages/default.png');
    }
}