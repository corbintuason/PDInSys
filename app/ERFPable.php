<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ERFPable extends Model
{
    protected $table = 'erfpables';
    
    protected $fillable = [
        'erfpable_type',
        'erfpable_id',

        'status',
        ''

    ];

    protected $casts = [
        "term_of_payment" => "Array",
    ];

    // Relationships
    public function erfpable(){
        return $this->morphTo();
    }
    public function vendor(){
        return $this->belongsTo('App\Vendor');
    }
}
