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
    public function erfpables(){
        return $this->hasMany("App\ERFPable", 'erfp_id');
    }
    public function term_of_payments(){
        return $this->hasMany("App\TermOfPayment", 'erfp_id');
    }
    public function check_writes(){
        return $this->hasMany("App\CheckWrite", 'erfp_id');
    }
    public function vendor(){
        return $this->belongsTo('App\Vendor');
    }
    public function closing_erfp(){
        return $this->hasOne('App\ClosingERFP', 'erfp_id');
    }
}
