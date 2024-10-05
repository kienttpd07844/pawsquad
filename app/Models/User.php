<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\CustomVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'email_verified',
        'token',
        'google_token',
        'ip_address',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendEmailVerificationNotificationCustom()
    {
        $verificationUrl = $this->createCustomVerificationUrl();
        Mail::to($this->email)->send(new CustomVerifyEmail($verificationUrl));
    }
    protected function createCustomVerificationUrl()
    {
        $hashedId = Crypt::encryptString($this->getKey());
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $hashedId, 'hash' => sha1($this->getEmailForVerification())]
        );
    }

    public function markEmailAsVerifiedCustom()
    {
        return $this->update([
            'email_verified' => (string) 1,
            'email_verified_at' => $this->freshTimestamp(),
        ]);
    }
}
