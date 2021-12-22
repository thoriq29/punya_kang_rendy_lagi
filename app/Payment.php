<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $appends = ['display_status'];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function getDisplayStatusAttribute()
    {
        $result = '';
        $status = $this->attributes['is_verification'];

        switch ($status) {
            case '0':
                $result = 'Menunggu Verifikasi';
                break;
            case '1':
                $result = 'Terverifikasi';
                break;

            default:
                $result = 'Tidak Ada';
                break;
        }

        return $result;
    }
}
