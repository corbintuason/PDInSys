<?php

namespace App\Traits;

use App\Mandate;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;

trait MandatesTrait
{

    use ControllersTrait;
    public function getCreateStatus(Request $request)
    {
        $roles = auth()->user()->getRoles()->toArray();
        $next_status;
        if (in_array('mandate-creator', $roles)) {
            $next_status = "For Approval";
        }
        return $next_status;
    }
}
