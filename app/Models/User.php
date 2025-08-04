<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'initial_name',
        'dob',
        'age',
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

    protected $apends = [
        'initial_name'
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {

            if ($user->dob) {
                $user->age = Carbon::parse($user->dob)->age;
            }
            if ($user->full_name) {

                $parts = explode(' ', trim($user->full_name));
                $initials = '';

                if (count($parts) > 1) {
                    $lastName = ucfirst(array_pop($parts));
                    $initials = '';
                    foreach ($parts as $part) {
                        $initials .= strtoupper(substr($part, 0, 1)) . '.';
                    }
                    $initials = $initials . ' ' . $lastName;
                }else{
                    $firstInitial = ucfirst($parts[0]);
                    $initials = $firstInitial;
                }

                $user->initial_name = $initials;
            }
        });

        static::updating(function ($user) {
            if ($user->dob) {
                $user->age = Carbon::parse($user->dob)->age;
            }
        });
    }
}
