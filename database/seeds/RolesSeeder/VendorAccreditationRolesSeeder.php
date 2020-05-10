<?php

use Illuminate\Database\Seeder;
use App\Vendor;

class VendorAccreditationRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // // Role Creation
        $vendor_creator = Bouncer::role()->firstOrCreate([
            'name' => 'vendor-creator',
            'title' => 'Creator',
            'entity' => Vendor::class
        ]);


        $vendor_approver = Bouncer::role()->firstOrCreate([
            'name' => 'vendor-approver',
            'title' => 'Approver',
            'entity' => Vendor::class
        ]);


        Bouncer::allow($vendor_creator)->to(['view-all', 'view', 'create'], Vendor::class);
        Bouncer::allow($vendor_approver)->to(['view-all', 'view', 'create', 'approve'], Vendor::class);
    }
}
