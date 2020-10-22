<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TermOfPaymentsTrait;
class TermOfPayment extends Model
{
    use TermOfPaymentsTrait;
    protected $table = 'term_of_payments';
    
    protected $fillable = [
        "payment",
        "erfp_id",
        "status",
        'ref_no',
        "file_name"
    ];

    protected $casts = [
        'created_at'  => 'datetime:m-d-Y',
    ];
    
    // Relationships
    public function erfp(){
        return $this->belongsTo("App\ERFP", 'erfp_id');
    }

}
