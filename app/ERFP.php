<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ERFPsTrait;

class ERFP extends Model
{
    use ERFPsTrait;
    protected $table = 'erfps';
    
    protected $fillable = [
        "rfp_date",
        "start_date",
        "end_date",
        "description",
        
        "venue",
        "quotation_no",
        "term_of_payment",
        
        'quotation_file',
        
        'bank_index',
        'status',
        
        "vendor_id",
        'requestor_id',

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
