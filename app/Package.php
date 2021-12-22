<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $appends = ['display_status'];
    
    public function getDisplayStatusAttribute()
    {
        $result = '';
        $status = $this->attributes['status'];

        switch ($status) {
            case '100':
                $result = 'Aktif';
                break;
            case '10':
                $result = 'Tidak Aktif';
                break;
            
            default:
                $result = 'Tidak Ada';
                break;
        }

        return $result;
    }
}
