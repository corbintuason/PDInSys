<?php

use Illuminate\Database\Seeder;
use App\Mandate;

class MandateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        
            // // Role Creation
            $mandate_creator = Bouncer::role()->firstOrCreate([
                'name' => 'mandate-creator',
                'title' => 'Creator',
                'entity' => Mandate::class
            ]);


            $mandate_approver = Bouncer::role()->firstOrCreate([
                'name' => 'mandate-approver',
                'title' => 'Approver',
                'entity' => Mandate::class
            ]);


            Bouncer::allow($mandate_creator)->to(['view-all', 'view', 'create'], Mandate::class);
            Bouncer::allow($mandate_approver)->to(['view-all', 'view', 'create', 'approve'], Mandate::class);
        
    }
}
