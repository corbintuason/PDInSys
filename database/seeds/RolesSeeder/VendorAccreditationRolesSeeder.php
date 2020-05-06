<?php

use Illuminate\Database\Seeder;

class VendorAccreditationRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $view_vendors = Bouncer::ability()->firstOrCreate([
            'name' => 'view-all-vendors',
            'title' => 'View All Vendors',
        ]);

        $create_vendors = Bouncer::ability()->firstOrCreate([
            'name' => 'create-vendors',
            'title' => 'Create Vendors',
        ]);

        $edit_vendors = Bouncer::ability()->firstOrCreate([
            'name' => 'edit-all-vendors',
            'title' => 'Edit All Vendors',
        ]);

        $delete_vendors = Bouncer::ability()->firstOrCreate([
            'name' => 'delete-all-vendors',
            'title' => 'Delete All Vendors',
        ]);

        // Project List - Create Project (PROCESS FLOW - CREATE, REVIEW, RETURN, REJECT, APPROVE)

        $approve_vendors = Bouncer::ability()->firstOrCreate([
            'name' => 'approve-all-vendors',
            'title' => 'Approve All vendors',
        ]);

        $reject_vendors = Bouncer::ability()->firstOrCreate([
            'name' => 'reject-all-vendors',
            'title' => 'Reject All Vendors'
        ]);

        $return_vendors = Bouncer::ability()->firstOrCreate([
            'name' => 'return-all-vendors',
            'title' => 'Return all Vendors'
        ]);



        // Role Creation
        $vendor_creator = Bouncer::role()->firstOrCreate([
            'name' => 'vendor-creator',
            'title' => 'Vendor Creator',
        ]);

        $vendor_approver = Bouncer::role()->firstOrCreate([
            'name' => 'vendor-approver',
            'title' => 'Vendor Approver'
        ]);

        // Approve
        Bouncer::allow($vendor_creator)->to([$view_vendors, $create_vendors]);
        Bouncer::allow($vendor_approver)->to([$view_vendors, $create_vendors, $edit_vendors, $delete_vendors, $return_vendors, $reject_vendors, $approve_vendors]);
    }
}
