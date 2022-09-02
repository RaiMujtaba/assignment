<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'address',
        'post_code',
        'city',
        'phonenumber'
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

    public function profiles() {
        return $this->hasMany(Profile::class);
    }

    public function scopeFilter(Model $query, string $field, mixed $value, string $operand, string $andOr='or') {
        switch (strtolower($operand)) {
            case 'in':
                if (!is_array($value)) {
                    $value = explode(',', $value);
                }
                return $andOr == 'and' ? $query->whereIn($field, $value) : $query->orWhereIn($field, $value);

            case 'notin':
                if (!is_array($value)) {
                    $value = explode(',', $value);
                }
                return $andOr == 'and' ? $query->whereNotIn($field, $value) : $query->orWhereNotIn($field, $value);

            case 'null':
                return $andOr == 'and' ? $query->whereNull($field) : $query->orWhereNull($field);

            case 'notnull':
                return $andOr == 'and' ? $query->whereNotNull($field) : $query->orWhereNotNull($field);

            case 'like':
                $value = '%s'.$value.'%s';
                return $andOr == 'and' ? $query->where($field, $operand, $value) : $query->orWhere($field, $operand, $value);

            case 'between':
                if (!is_array($value)) {
                    $value = explode(',', $value);
                }
                if (count($value) === 2) {
                    return $andOr == 'and' ? $query->whereBetween($field, $value) : $query->orWhereBetween($field, $value);
                }
                break;
            default:
                return $andOr == 'and' ? $query->where($field, $operand, $value) : $query->orWhere($field, $operand, $value);
        }
    }

    public function getTableName() {
        return 'users';
    }
}
