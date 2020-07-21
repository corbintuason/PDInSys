<?php

namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\User;
use App\Contributor;
use Notification;
use App\Notifications\ItemNotification;
use App\Remark;
trait ControllersTrait
{

    public function getCreateStatus($request, $class, $overflow)
    {
        if($overflow){
        // Get Roles of User
        $roles = auth()->user()->roles;
        // Find Role of User in Stages
        $model_role = $roles->where('entity', $class)->first();
        $next_stage = $this->getNextStageByResponsibility($model_role, $class);
        return $next_stage->names[0];
        }else{
        $next_stage = $this->getNextStageByProcess($class);
        return $next_stage->names[0];
        }
    }

    public function getNextStageByProcess($class){
        $stages = (new $class)->stages;
        return $stages[1];
    }

    public function getNextStageByResponsibility($model_role, $class)
    {
        // Instantate Class to See Statuses
        $stages = (new $class)->stages;
        $current_stage = $stages->where('responsible.role', $model_role->name)->first();
        return $stages->slice($stages->search($current_stage) + 1, 1)->first();
    }

    public function getNextStage($item)
    {
        $current_stage = $this->getCurrentStage($item);
        $curr_index = $item->stages->search($current_stage);
        $next_stage = $item->stages->slice($curr_index + 1, 1)->first();
        return $next_stage;
    }

    public function getRoleIn($class)
    {
        $roles = auth()->user()->roles;
        // dd($roles);
        $role = $roles->where('entity', $class)->first();
        $responsibility = $role->title;
        return $responsibility;
    }

    public function notifyApprovers($item)
    {
        $users = User::all();
        if(!$item->is_process_finished){
            $approvers = $users->filter(function ($user) use ($item) {
                return $user->can($this->getCurrentStage($item)->responsible->name, get_class($item));
            });
            return $approvers;
        }
        return [];

        // return User::whereIs($this->getCurrentStage($item)->responsible)->get();
    }

    public function addContributor($item, $class, $overflow)
    {
        $auth_user = auth()->user();
        $responsibility = $this->getRoleIn($class);
        // if($overflow){
        //     // $responsibility = $this->getRoleIn($class);
        //     $responsibility = "Test";

        // }else{
        //     $responsibility = "Creator";
        // }
        Contributor::create([
            'contributable_type' => $class,
            'contributable_id' => $item->id,
            'contributor_id' => $auth_user->id,
            'responsibility' => $responsibility
        ]);
    }
    public function getCurrentStage($item)
    {
        $stages = $item->stages;
        foreach ($stages as $stage) {
            foreach ($stage->names as $name) {
                if ($name == $item->status) {
                    $current_stage = $stage;
                    break;
                }
            }
        }
        return $current_stage;
    }

    /** Only use this function IF:
     *  - Request contains ALL fields
     *  - Has a CONTRIBUTOR
     *  - Authorized User will be allowed to EDIT
     *  - Activity log is GENERIC
     * 
     * OTHERWISE: 
     *  - You may copy each action, and put it in your Controller@store instead.
     */
    public function createItem($request, $class, $model_text, $overflow)
    {
        $auth_user = auth()->user();

        /**
         * OVERFLOW:
         *  - Boolean Value where it will determine if we should get the status based on the role of the creator
         *  or based on the standard flow of the process!
         */

        $request['status'] = $this->getCreateStatus($request, $class, $overflow);
        // $request['status'] = $this->getNextStatus($request, $class, $overflow);
        // Create Item
        $item = activity()->withoutLogs(function () use ($request, $class) {
            return $class::create($request->all());
        });

        // Create Contributor Object
        $this->addContributor($item, $class, $overflow);

        // Authorize user to edit this item
        $auth_user->allow('edit', $item);
        
        // Create Activity Log
        activity($model_text . ' Created')
            ->on($item)
            ->log($auth_user->full_name . " has created " . $model_text . " " . $item->code);

        return $item;
    }

    public function updateItem($item, $class, $model_text, $request, $overflow)
    {
        $auth_user = auth()->user();
        // Generate Status based on Creator
        $updated_status =  $this->getNextStage($item)->names[0];

        // Create Item
        activity()->withoutLogs(function () use ($item, $updated_status) {
            $item->update([
                'status' => $updated_status
            ]);
        });

        // Create Contributor Object
        $this->addContributor($item, $class, $overflow);

        // Authorize user to edit this item
        $auth_user->allow('edit', $item);
        
        //  Add Skip remark if checked
        if($request->get("skipped")){
            $this->skipRemark($item, $class);
        }

        // Create Activity Log
        activity($model_text . ' Status Change')
            ->on($item)
            ->log($auth_user->full_name . " has changed " . $model_text . " " . $item->code . "'s status to " . $item->status);

        return $item;
    }

    public function filterForUpdating($old_item, $new_item)
    {
        // $attributes = $old_item->getAttributes();
        // $attribute_keys = array_keys($attributes);
        // $arr = json_decode(json_encode($new_item), TRUE);
        // $filtered = array_filter(
        //     $arr,
        //     function ($key) use ($attribute_keys) {
        //         return in_array($key, $attribute_keys);
        //     },
        //     ARRAY_FILTER_USE_KEY
        // );

        // $result = array_diff_assoc($filtered, $attributes);
        // return $result;

        $attributes = $old_item->getAttributes();
        $attribute_keys = array_keys($attributes);
        $arr = json_decode(json_encode($new_item), TRUE);
        $filtered = array_filter($arr, function ($key) use ($attribute_keys) {
            return in_array($key, $attribute_keys);
        }, ARRAY_FILTER_USE_KEY);

        // DONT DELETE, THIS ACTUALLY WORKS FOR COMPARING JSON OBJECTS
        // $result = [];
        // foreach($filtered as $key => $value){
        //     if(is_array($filtered[$key])){
        //         $array_key = [];
        //         $test = json_decode($attributes[$key]);
        //         foreach($value as $new_key => $new_value){
        //             $result = array_diff_assoc($new_value, (array) $test[$new_key]);
        //             if(!empty($result)){
        //                 array_push($array_key, $result);
        //             }
        //         } $result[$key] = $array_key;
        //         dd($result);
        //         // $result = array_diff_assoc($value, $attributes[$key]);
        //     }
        // }
        $result = array_diff_assoc($filtered, $attributes);
        dd($result);
    }

    public function saveItem($request, $class, $model_text, $show_route)
    {
        $auth_user = auth()->user();
        // Generate Status based on Creator
        $request['status'] = $this->getCreateStatus($request, $class);

        // Create Item
        $item = activity()->withoutLogs(function () use ($request, $class) {
            return $class::create($request->all());
        });

        // Authorize user to edit this item
        $auth_user->allow('edit', $item);

        // Create Activity Log
        activity($model_text . ' Saved')
            ->on($item)
            ->log($auth_user->full_name . " has created " . $model_text . " " . $item->code);

        return $item;
    }

    public function getReturnStatus($remark, $class){
        // Get stages of Remarkable
        $stages = $remark->remarkable->stages;
        $returned_to = User::findOrFail($remark->returned_to_id);
        $role = $returned_to->roles->where('entity', $class)->first();
        $stage = $stages->where('responsible.role', $role->name)->first();
        return $stage->names[1];
    }

    public function return($request, $class, $model_text){
        $auth_user = auth()->user();

        // Create Remark
        $item = $class::findOrFail($request['remarkable_id']);
        $remark = Remark::create([
            'remarkable_type' => $class,
            'remarkable_id' => $item->id,
            'returned_to_id' => $request->user["id"],
            'remarked_by_id' => $auth_user->id,
            'type' => "Return",
            'remarks' => $request['remarks']
        ]);
        
        // Update Item
        $remarkable = $remark->remarkable;

        $return_status = $this->getReturnStatus($remark, $class);
        activity()->withoutLogs(function () use ($remarkable, $return_status) {
            $remarkable->update([
                'status' => $return_status
            ]);
        });


        activity($model_text . " " . $remarkable->code. " Returned")
            ->on($remarkable)
            ->log($auth_user->full_name . " has returned " . $model_text . " " . $remarkable->code. " to " . $remark->returned_to->full_name);

        return $remark;
    }

    public function rejectItem($request, $class, $item, $model_text){
        $auth_user = auth()->user();
        // Change Status of Item to Rejected
        activity()->withoutLogs(function () use ($item) {
            $item->update([
                'status' => 'Rejected'
            ]);
        });

        $remark = Remark::create([
            'remarkable_type' => $class,
            'remarkable_id' => $item->id,
            'remarked_by_id' => $auth_user->id,
            'type' => "Reject",
            'remarks' => $request->all()
        ]);

        // Create Activity
        activity($model_text . " " . $item->code. " has been set to Rejected")
            ->on($item)
            ->log($auth_user->full_name . " has Rejected " . $model_text . " " . $item->code);
        return $item;
    }

    public function getContributors($item){
        $contributors = collect([]);
        foreach($item->contributors as $contributor){
            $contributors->push($contributor->user);
        }
        return $contributors->unique('id');
    }

    public function saveChangesToItem($request, $class, $item, $model_text, $overflow){
        $auth_user = auth()->user();

        activity()->withoutLogs(function () use ($item, $request) {
            $item->update($request->all());
        });
        
        // $item, $class, $model_text, $request, $overflow
        $this->updateItem($item, $class, $model_text, $request, $overflow);

        activity($model_text . " Edited")
        ->on($item)
        ->log($auth_user->full_name . " has edited ". $item->code);

        return $item;

    }

    public function skipRemark($item, $class){
        $auth_user = auth()->user();
        Remark::create([
            'remarkable_type' => $class,
            'remarkable_id' => $item->id,
            'remarked_by_id' => $auth_user->id,
            'type' => "Skip",
            'remarks' => ["Please review this thoroughly because I did not review it properly."]
        ]);
    }

}
