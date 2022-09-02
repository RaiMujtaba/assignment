<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'name',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $visible = [
        'uid',
        'object',
        'created',
        'updated',
        'status',
        'name',
        'sector',
        'url',
        'contact',
        'settings',
        'bank_account',
        'payment_methods',
        'files',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
