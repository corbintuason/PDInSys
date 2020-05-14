<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\Traits\SeedsTrait;
class ProjectDevelopmentRolesSeeder extends Seeder
{
    use SeedsTrait;
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
        ];
        $generic_abilities = ["view-all", "view", "create"];
        $this->createRoles($roles, $generic_abilities, Project::class, "project");
    }
}
