<?php

use Illuminate\Database\Seeder;
use App\Project;
class ProjectDevelopmentRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            (object) array("name" => "Creator",
            "ability" => null),
            (object) array("name" => "Reviewer",
            "ability" => "review"),
            (object) array("name" => "Approver",
            "ability" => "approve"),
            (object) array("name" => "Assigner",
            "ability" => "assign"),
        ];
        $generic_abilities = ["view-all", "view", "create"];
        foreach($roles as $role){
            $user_role = Bouncer::role()->firstOrCreate([
                'name' => "project-".strtolower($role->name),
                'title' => $role->name,
                'entity' => Project::class
            ]);
            $user_abilities = $generic_abilities;
            if($role->ability!=null){
                array_push($user_abilities, $role->ability);
            }
            Bouncer::allow($user_role)->to($user_abilities, Project::class);
        }
    }
}
