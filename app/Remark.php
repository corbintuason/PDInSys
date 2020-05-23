<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $fillable=["remarkable_type", "remarkable_id", "returned_to_id", "remarked_by_id", "remarks", "type"];

    protected $casts = [
        'remarks' => 'array'
    ];

    public function remarkable(){
        return $this->morphTo();
    }

    public function remarked_by(){
        return $this->belongsTo("App\User", "remarked_by_id");
    }
    
    public function returned_to(){
        return $this->belongsTo("App\User", "returned_to_id");
    }
}
