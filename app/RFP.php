<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\RFPsTrait;

class RFP extends Model
{
    use RFPsTrait;
    protected $table = 'rfps';
    
    protected $fillable = [
        "rfp_date",
        "start_date",
        "end_date",
        "description",
        
        "venue",
        "quotation_no",
        "term_of_payment",
        "billing_amount",
        
        'status',
        "vendor_id",
        'requestor_id',

    ];

    protected $casts = [
        "term_of_payment" => "Array"
    ];

    // Relationships
    public function rfpable(){
        return $this->morphTo();
    }
}