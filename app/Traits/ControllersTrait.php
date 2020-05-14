<?php

namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\User;
use App\Contributor;
use Notification;
use App\Notifications\ItemNotification;

trait ControllersTrait
{

    public function getCreateStatus($request, $class)
    {
        // Get Roles of User
        $roles = auth()->user()->roles;
        // Find Role of User in Stages
        $model_role = $roles->where('entity', $class)->first();
        $next_stage = $this->getNextStageByResponsibility($model_role, $class);
        return $next_stage->names[0];
    }

    public function getNextStageByResponsibility($model_role, $class)
    {
        // Instantate Class to See Statuses
        $stages = (new $class)->stages;
        $current_stage = $stages->where('responsible', $model_role->name)->first();
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
        $role = $roles->where('entity', $class)->first();
        $responsibility = $role->title;
        return $responsibility;
    }

    public function notifyApprovers($item)
    {
        return User::whereIs($this->getCurrentStage($item)->responsible)->get();
    }

    public function addContributor($item, $class)
    {
        $auth_user = auth()->user();
        $responsibility = $this->getRoleIn($class);
        Contributor::create([
            'contributable_type' => $class,
            'contributable_id' => $item->id,
            'contributor_id' => $auth_user->id,
            'responsibility' => $responsibility
        ]);
    }
    public function getCurrentStage($item)
    {
        // $stages = $item->stages;
        // $current_stage;
        // foreach($stages as $stage){
        //     $names = $stage->names;
        //     if(in_array($item, $names)){
        //         $current_stage = $stage;
        //     break;
        //     }else{
        //         continue;
        //     }
        // }
        // dd($current_stage);
        // Get Stages Attribute
        $stages = $item->stages;
        // Find a stage where it the status is in one of the names
        foreach ($stages as $stage) {
            foreach ($stage->names as $name) {
                if ($name == $item->status) {
                    $current_stage = $stage;
                    break;
                }
            }
        }
        // Return stage

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
    public function createItem($request, $class, $model_text, $show_route)
    {
        $auth_user = auth()->user();
        // Generate Status based on Creator
        $request['status'] = $this->getCreateStatus($request, $class);

        // Create Item
        $item = activity()->withoutLogs(function () use ($request, $class) {
            return $class::create($request->all());
        });

        // Create Contributor Object
        $this->addContributor($item, $class);

        // Authorize user to edit this item
        $auth_user->allow('edit', $item);

        Notification::send($this->notifyApprovers($item), new ItemNotification($item, $item::$module, $show_route));

        // Create Activity Log
        activity($model_text . ' Created')
            ->on($item)
            ->log($auth_user->full_name . " has created " . $model_text . " " . $item->code);

        return $item;
    }

    public function updateItem($item, $class, $model_text, $show_route)
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
        $this->addContributor($item, $class);

        // Authorize user to edit this item
        $auth_user->allow('edit', $item);

        // Notify Next Users
        $module_name = $model_text . " Module";
        Notification::send($this->notifyApprovers($item), new ItemNotification($item, $item::$module, $show_route));

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
}
