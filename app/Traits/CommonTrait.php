<?php
namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\User;
use App\Contributor;
trait CommonTrait {

    public function getNextStage($item) {
        $stages = $item->stages;
        $current_stage = $this->getCurrentStage($item);
        $curr_index = $stages->search($current_stage);
        $next_stage = $stages->slice($curr_index+1, 1)->first();
        return $next_stage;
    }

    public function getCurrentStage($item){
        return $item->stages->where('name', $item->status)->first();
    }

    public function getRoleIn($class){
        $roles = auth()->user()->roles;
        $role = $roles->where('entity', $class)->first();
        $responsibility = $role->title;
        return $responsibility;
    }

    public function notifyApprovers($item){
        return User::whereIs($this->getCurrentStage($item)->responsible)->get();
    }

    public function addContributor($item){
        $auth_user = auth()->user();
        $class = get_class($item);
        $responsibility = $this->getRoleIn($class);
        Contributor::create([
            'contributable_type' => $class,
            'contributable_id' => $item->id,
            'contributor_id' => $auth_user->id,
            'responsibility' => $responsibility
        ]);
    }
}