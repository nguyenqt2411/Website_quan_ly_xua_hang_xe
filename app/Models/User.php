<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;


class User extends Authenticatable
{
    use HasFactory, Notifiable, LaravelEntrustUserTrait;
    const STATUS = [
        1 => 'Hoạt động',
        2 => 'Đã khóa',
    ];

    const GENDERS = [
        1 => 'Nam',
        2 => 'Nữ',
        3 => 'Không xác định'
    ];

    const CLASS_STATUS = [
        2 => 'btn-danger',
        1 => 'btn-success'
    ];


    const ACTIVE  = 1;
    const LOCK  = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id',
        'user_no',
        'name',
        'email',
        'password',
        'phone',
        'email_verified_at',
        'avatar',
        'address',
        'status',
        'gender',
        'birthday',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getInfoEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function userRole()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

}

