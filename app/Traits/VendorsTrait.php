<?php

namespace App\Traits;

use App\Vendor;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;

trait VendorsTrait
{

    use ControllersTrait;
    public function getCreateStatus(Request $request)
    {
        $roles = auth()->user()->getRoles()->toArray();
        $next_status;
        if (in_array('vendor-creator', $roles)) {
            $next_status = "For Approval";
        }
        return $next_status;
    }
}