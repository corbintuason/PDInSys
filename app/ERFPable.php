<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ERFPablesTrait;
class ERFPable extends Model
{
    use ERFPablesTrait;
    protected $table = 'erfpables';
    
    protected $fillable = [
        'erfpable_type',
        'erfpable_id',

        'status',
        'billing_amount',
        'erfp_id'

    ];

    // Relationships
    public function erfpable(){
        return $this->morphTo();
    }
    public function erfp(){
        return $this->belongsTo('App\ERFP');
    }

}
