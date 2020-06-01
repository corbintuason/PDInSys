<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
use App\BudgetRequest;
class BudgetRequestRolesSeeder extends Seeder
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
                    "name" => "Releaser",
                    "ability" => "release"
                ),
                (object) array(
                    "name" => "Disburser",
                    "ability" => "disburse"
                ),
            ];
    
            // Define Generic Abilities
            $generic_abilities = ["view-all", "view", "create"];

            $role_text = "budget-request";
    
            // Create Roles
            $bouncer_roles = $this->createRoles($roles, $generic_abilities, BudgetRequest::class, $role_text);
            
            
            // From Other Modules
            foreach($bouncer_roles as $bouncer_role){
                Bouncer::allow($bouncer_role)->to("view", "App\\Project");
                Bouncer::allow($bouncer_role)->to("view-all", "App\\Project"); 
            }
    }
}
