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

        $budget_allocation_adm = Bouncer::role()->firstOrCreate([
            'name' => 'budget-allocation-adm',
            'title' => 'Admin Head',
            'entity' => BudgetAllocation::class
        ]);

        $budget_allocation_afg = Bouncer::role()->firstOrCreate([
            'name' => 'budget-allocation-afg',
            'title' => 'Accounting Head',
            'entity' => BudgetAllocation::class
        ]);

        $budget_allocation_hr = Bouncer::role()->firstOrCreate([
            'name' => 'budget-allocation-hr',
            'title' => 'HR Head',
            'entity' => BudgetAllocation::class
        ]);

        $budget_allocation_ops = Bouncer::role()->firstOrCreate([
            'name' => 'budget-allocation-ops',
            'title' => 'VP for Gen Ops',
            'entity' => BudgetAllocation::class
        ]);

        Bouncer::allow($budget_allocation_creator)->to(['view-all', 'view', 'create'], BudgetAllocation::class);
        Bouncer::allow($budget_allocation_adm)->to(['view-all', 'view'], BudgetAllocation::class);
        Bouncer::allow($budget_allocation_afg)->to(['view-all', 'view'], BudgetAllocation::class);
        Bouncer::allow($budget_allocation_hr)->to(['view-all', 'view'], BudgetAllocation::class);
        Bouncer::allow($budget_allocation_ops)->to(['view-all', 'view'], BudgetAllocation::class);
    }
}
