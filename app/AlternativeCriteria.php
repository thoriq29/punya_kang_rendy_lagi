<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlternativeCriteria extends Model
{
    protected $table = 'alternative_criteria';
    
    protected $appends = ['display_status'];
    public $timestamps = false;

    public function alternative()
    {
        return $this->belongsTo('App\Package', 'alternative_id');
    }

    public function criteria()
    {
        return $this->belongsTo('App\Criteria', 'criteria_id');
    }
    
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
}
