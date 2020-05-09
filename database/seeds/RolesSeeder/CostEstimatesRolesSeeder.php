<?php

use Illuminate\Database\Seeder;
use App\CostEstimateDetail;
class CostEstimatesRolesSeeder extends Seeder
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
            (object) array("name" => "Clearer",
            "ability" => "assign"),
            (object) array("name" => "Signer",
            "ability" => "sign")
        ];
        $generic_abilities = ["view-all", "view", "create"];
        foreach($roles as $role){
            $user_role = Bouncer::role()->firstOrCreate([
                'name' => "cost-estimate-".strtolower($role->name),
                'title' => $role->name,
                'entity' => CostEstimateDetail::class
            ]);
            $user_abilities = $generic_abilities;
            if($role->ability!=null){
                array_push($user_abilities, $role->ability);
            }
            Bouncer::allow($user_role)->to($user_abilities, CostEstimateDetail::class);
        }
    }
}
