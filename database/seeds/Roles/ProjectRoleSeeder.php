<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
use App\Project;
class ProjectRolesSeeder extends Seeder
{
    use SeedsTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           // Define Roles
           $roles = [
            (object) array(
                "name" => "Creator",
                "ability" => null
            ),
            (object) array(
                "name" => "Reviewer",
                "ability" => "review"
            ),
            (object) array(
                "name" => "Approver",
                "ability" => "approve"
            ),
            (object) array(
                "name" => "Assigner",
                "ability" => "assign"
            )
        ];
        $generic_abilities = ["view-all", "view", "create"];

        // If role has 2 words, add a dash (cost-estimate)
        $role_text = "project";

        // Create Roles
        $bouncer_roles = $this->createRoles($roles, $generic_abilities, Project::class, $role_text);
    }
}
