<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Remark;
use App\Notifications\ItemReturned;
use Notification;
use App\User;

class RemarkController extends Controller
{
    public function index(){
        return Remark::all();

    }

    public function store(Request $request){
        $returned_by_id = auth()->user()->id;
    
        $remark = Remark::create([
            'remarkable_type' => "App\\". $request['remarkable_type'],
            'remarkable_id' => $request['remarkable_id'],
            'returned_to_id' => $request['user']['id'],
            'returned_by_id' => $returned_by_id,
            'remarks' => $request['remarks']
        ]);
        
        // Set status of item to returned
        $remarkable = $remark->remarkable;
        
        // $remarkable->update([
        //     "status" => "Returned"
        // ]);

        // Send notification to returned_to_id that the item has been returned to him/her
        $returned_to = User::findOrFail($remark->returned_to_id);        
        $config = new stdClass;
        $config->name = "Item Returned";

        $link = new stdClass;
        $link->name = $request["show_link_route"];
        $link->id = $remarkable->id;
        
        $notification_table = new stdClass;
        $notification_table->project_name = $config->name;
        $notification_table->item = 
        Notification::send($returned_to, new ItemReturned($remarkable, $config));
        return $remark;
    }

}
