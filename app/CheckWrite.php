<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CheckWritesTrait;
class CheckWrite extends Model
{
    use CheckWritesTrait;
    protected $table = 'check_writes';
    
    protected $fillable = [
        "erfp_id",
        "status",
    ];

    protected $casts = [
        'created_at'  => 'datetime:m-d-Y',
    ];

    // Relationships
    public function erfp(){
        return $this->belongsTo("App\ERFPable", 'erfp_id');
    }

}
