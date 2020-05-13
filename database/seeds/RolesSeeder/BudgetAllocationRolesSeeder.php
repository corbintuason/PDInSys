<?php

use Illuminate\Database\Seeder;
use App\BudgetAllocation;

class BudgetAllocationRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // // Role Creation
        $budget_allocation_creator = Bouncer::role()->firstOrCreate([
            'name' => 'budget-allocation-creator',
            'title' => 'Creator',
            'entity' => BudgetAllocation::class
        ]);

        $budget_allocation_receiver = Bouncer::role()->firstOrCreate([
            'name' => 'budget-allocation-receiver',
            'title' => 'Receiver',
            'entity' => BudgetAllocation::class
        ]);

        Bouncer::allow($budget_allocation_creator)->to(['view-all', 'view', 'create'], BudgetAllocation::class);
        Bouncer::allow($budget_allocation_receiver)->to(['view-all', 'view'], BudgetAllocation::class);
    }
}
