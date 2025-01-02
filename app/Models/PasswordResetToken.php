<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PasswordResetToken extends Model
{
    protected $fillable = ['email', 'token', 'created_at'];

    // Specify the primary key for the model
    protected $primaryKey = 'email';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Specify that the primary key is a string (not an integer)
    protected $keyType = 'string';

    // Disable timestamps, as we only need 'created_at' for expiration
    public $timestamps = false;


    function is_expired()
    {
        $expiration_duration_in_minutes = 60;
        return Carbon::parse($this->created_at)->addMinutes($expiration_duration_in_minutes)->isPast();
    }
}
