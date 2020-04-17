<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder; 

class UserBuilder extends Builder 
{ 
   public function whereRole() 
   { 
       $this->where('due', '=', 1); 
       return $this; 
   } 
}


