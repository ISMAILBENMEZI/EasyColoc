<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name',
        'email',
        'password',
        'role_id',
        'is_banned',
        'reputation',
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function createdExpenses()
    {
        return $this->hasMany(Expense::class , 'created_by');
    }

    public function paidExpenses()
    {
        return $this->hasMany(Expense::class , 'payer_id');
    }

    public function invitasionsSent()
    {
        return $this->hasMany(Invitation::class , 'created_by');
    }

    public function paymentsSent()
    {
        return $this->hasMany(Payment::class , 'from_user_id');
    }

    public function paymentsReceived()
    {
        return $this->hasMany(Payment::class , 'to_user_id');
    }

    public function isBanned()
    {
        return (bool) $this->is_banned;
    }
}
