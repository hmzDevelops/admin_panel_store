<?php

namespace App\Models;

use App\Models\Market\Payment;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'mobile',
        'email',
        'status',
        'password',
        'user_type',
        'activation',
        'profile_photo_path',
        'deleted_at',
        'email_verified_at',
        'mobile_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    protected $table = "users";

    public function getFullNameAttribute(){
        return $this->firstname . ' ' . $this->lastname;
    }


    public function ticketAdmin(){
        return $this->hasOne(TicketAdmin::class);
    }


    //تعداد تیکت های هر یوزر
    public function tickets(){
        return $this->hasMany(Ticket::class, 'parent_id');
    }


    //هر یوزر چندین نقش دارد
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    //هر یوزر چندین پیمنت دارد
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
