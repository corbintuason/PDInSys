<?php

use Illuminate\Database\Seeder;
use App\CostEstimateDetail;
use App\SignedCostEstimateDetail;
use App\Traits\SeedsTrait;
class CostEstimatesRolesSeeder extends Seeder
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
            (object) array("name" => "Clearer",
            "ability" => "assign"),
        ];
        $generic_abilities = ["view-all", "view", "create"];

        $this->createRoles($roles, $generic_abilities, CostEstimateDetail::class, "cost-estimate");
        $this->createRoles($roles, $generic_abilities, SignedCostEstimateDetail::class, "signed-cost-estimate");
        
        // foreach($roles as $role){
        //     $user_role = Bouncer::role()->firstOrCreate([
        //         'name' => "signed-cost-estimate-".strtolower($role->name),
        //         'title' => $role->name,
        //         'entity' => SignedCostEstimateDetail::class
        //     ]);
        //     $user_abilities = $generic_abilities;
        //     if($role->ability!=null){
        //         array_push($user_abilities, $role->ability);
        //     }
        //     Bouncer::allow($user_role)->to($user_abilities, SignedCostEstimateDetail::class);
        // }
    }
}
