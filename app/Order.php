<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends = ['display_status', 'payment_type_name'];

    public function payment()
    {
        return $this->hasMany('App\Payment', 'order_id');
    }

    public function package()
    {
        return $this->belongsTo('App\Package', 'package_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\User', 'customer_id');
    }

    public function getDisplayStatusAttribute()
    {
        $result = '';
        $status = $this->attributes['status'];

        switch ($status) {
            case '100':
                $result = 'Menunggu Pembayaran';
                break;
            case '200':
                $result = 'Telah Dibayar Sebagian';
                break;
            case '210':
                $result = 'Telah Dibayar LUNAS';
                break;
            case '300':
                $result = 'Selesai';
                break;
            case '10':
                $result = 'Dibatalkan';
                break;

            default:
                $result = 'Tidak Ada';
                break;
        }

        return $result;
    }

    public function getPaymentTypeNameAttribute()
    {
        $result = '';
        $attr = $this->attributes['payment_type'];

        switch ($attr) {
            case 'lumpsum':
                $result = 'Bayar Sekaligus';
                break;
            case 'parsial':
                $result = 'Cicilan';
                break;

            default:
                $result = 'Tidak Ada';
                break;
        }

        return $result;
    }
}
