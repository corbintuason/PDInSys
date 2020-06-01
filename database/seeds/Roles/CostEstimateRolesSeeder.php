<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
use App\CostEstimateDetail;
class CostEstimateRolesSeeder extends Seeder
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
                "name" => "Clearer",
                "ability" => "clear"
            ),
        ];

        // Define Generic Abilities
        $generic_abilities = ["view-all", "view", "create"];

        $role_text = "cost-estimate";

        // Create Roles
        $bouncer_roles = $this->createRoles($roles, $generic_abilities, CostEstimateDetail::class, $role_text);

        // Create Users
        // $this->createUsers($bouncer_roles, "CostEstimate");
    }
}
