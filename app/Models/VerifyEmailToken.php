<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyEmailToken extends Model
{
    protected $fillable = ['email', 'token'];

    // Specify the primary key for the model
    protected $primaryKey = 'email';

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Specify that the primary key is a string (not an integer)
    protected $keyType = 'string';

    // Disable timestamps, as we only need 'created_at' for expiration
    public $timestamps = false;

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
