<?php

use Illuminate\Database\Seeder;

class AccountsAndClientsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $view_accounts = Bouncer::ability()->firstOrCreate([
            'name' => 'view-all-accounts',
            'title' => 'View All accounts',
        ]);

        $create_accounts = Bouncer::ability()->firstOrCreate([
            'name' => 'create-accounts',
            'title' => 'Create accounts',
        ]);

        $edit_accounts = Bouncer::ability()->firstOrCreate([
            'name' => 'edit-all-accounts',
            'title' => 'Edit All accounts',
        ]);

        $delete_accounts = Bouncer::ability()->firstOrCreate([
            'name' => 'delete-all-accounts',
            'title' => 'Delete All accounts',
        ]);

                
        // Vie Accounts - Account and Client Acc. (PROCESS FLOW - CREATE, RETURN, REJECT, APPROVE)

        $approve_accounts = Bouncer::ability()->firstOrCreate([
            'name' => 'approve-all-accounts',
            'title' => 'Approve All accounts',
        ]);

        $reject_accounts = Bouncer::ability()->firstOrCreate([
            'name' => 'reject-all-accounts',
            'title' => 'Reject All accounts'
        ]);
        
        $return_accounts = Bouncer::ability()->firstOrCreate([
            'name' => 'return-all-accounts',
            'title' => 'Return all accounts'
        ]);


        
        // Role Creation
        $account_creator = Bouncer::role()->firstOrCreate([
            'name' => 'account-creator',
            'title' => 'Account Creator',
        ]);

        $account_approver = Bouncer::role()->firstOrCreate([
            'name' => 'account-approver',
            'title' => 'Account Approver'
        ]);

        // Assign
        Bouncer::allow($account_creator)->to([$view_accounts, $create_accounts]);
        Bouncer::allow($account_approver)->to([$view_accounts, $create_accounts, $edit_accounts, $delete_accounts, $return_accounts, $approve_accounts]);
    
    }
}
