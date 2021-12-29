<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'identity_card'
    ];

    protected $appends = ['display_status'];

    public function getDisplayStatusAttribute()
    {
        $result = '';
        $status = $this->attributes['status'];

        switch ($status) {
            case '1':
                $result = 'Aktif';
                break;
            case '0':
                $result = 'Tidak Aktif';
                break;
            
            default:
                $result = 'Tidak Ada';
                break;
        }

        return $result;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function member()
    {
        return $this->hasOne('App\Member', 'user_id');
    }

    public function order()
    {
        return $this->hasMany('App\Order', 'customer_id');
    }
}
