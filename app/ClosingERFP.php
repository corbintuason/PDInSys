<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ClosingERFPsTrait;
class ClosingERFP extends Model
{
    use ClosingERFPsTrait;
    protected $table = 'closing_erfps';
    
    protected $fillable = [
       'receipts',

       'status',
       'erfp_id'
    ];

    protected $casts = [
        'created_at'  => 'datetime:m-d-Y',
        'receipts' => 'Array'
    ];

    // Relationships
    public function erfp(){
        return $this->belongsTo("App\ERFP", 'erfp_id');
    }

}
