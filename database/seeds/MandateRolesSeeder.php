<?php

use Illuminate\Database\Seeder;

class MandateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { {
            $view_mandates = Bouncer::ability()->firstOrCreate([
                'name' => 'view-all-mandates',
                'title' => 'View All Mandates',
            ]);

            $create_mandates = Bouncer::ability()->firstOrCreate([
                'name' => 'create-mandates',
                'title' => 'Create Mandates',
            ]);

            $edit_mandates = Bouncer::ability()->firstOrCreate([
                'name' => 'edit-all-mandates',
                'title' => 'Edit All Mandates',
            ]);

            $delete_mandates = Bouncer::ability()->firstOrCreate([
                'name' => 'delete-all-mandates',
                'title' => 'Delete All Mandates',
            ]);

            // Mandate List - Create Mandate (PROCESS FLOW - CREATE, RETURN, REJECT, APPROVE)

            $approve_mandates = Bouncer::ability()->firstOrCreate([
                'name' => 'approve-all-mandates',
                'title' => 'Approve All Mandates',
            ]);

            $reject_mandates = Bouncer::ability()->firstOrCreate([
                'name' => 'reject-all-mandates',
                'title' => 'Reject All Mandates'
            ]);

            $return_mandates = Bouncer::ability()->firstOrCreate([
                'name' => 'return-all-mandates',
                'title' => 'Return all Mandates'
            ]);

            // Role Creation
            $mandate_creator = Bouncer::role()->firstOrCreate([
                'name' => 'mandate-creator',
                'title' => 'Mandate Creator',
            ]);

            $mandate_approver = Bouncer::role()->firstOrCreate([
                'name' => 'mandate-approver',
                'title' => 'Mandate Approver'
            ]);

            // Approve
            Bouncer::allow($mandate_creator)->to([$view_mandates, $create_mandates]);
            Bouncer::allow($mandate_approver)->to([$view_mandates, $create_mandates, $edit_mandates, $delete_mandates, $return_mandates, $reject_mandates, $approve_mandates]);
        }
    }
}
