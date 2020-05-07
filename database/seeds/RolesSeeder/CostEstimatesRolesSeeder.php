<?php

use Illuminate\Database\Seeder;
use App\CostEstimate;
class CostEstimatesRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // $view_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'view-all-cost-estimates',
        //     'title' => 'View All cost-estimates',
        // ]);

        // $create_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'create-cost-estimates',
        //     'title' => 'Create cost-estimates',
        // ]);

        // $edit_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'edit-all-cost-estimates',
        //     'title' => 'Edit All cost-estimates',
        // ]);

        // $delete_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'delete-all-cost-estimates',
        //     'title' => 'Delete All cost-estimates',
        // ]);
        
        // // Project List - Create Project (PROCESS FLOW - CREATE, REVIEW, RETURN, REJECT, APPROVE)

        // $approve_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'approve-all-cost-estimates',
        //     'title' => 'Approve All cost-estimates',
        // ]);
        
        // $review_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'review-all-cost-estimates',
        //     'title' => 'Review All cost-estimates',
        // ]);

        // $clear_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'clear-all-cost-estimates',
        //     'title' => 'CLear All cost-estimates'
        // ]);

        // $reject_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'reject-all-cost-estimates',
        //     'title' => 'Reject All cost-estimates'
        // ]);
        
        // $return_cost_estimates = Bouncer::ability()->firstOrCreate([
        //     'name' => 'return-all-cost-estimates',
        //     'title' => 'Return all cost-estimates'
        // ]);


        
        // // Role Creation
        // $cost_estimate_creator = Bouncer::role()->firstOrCreate([
        //     'name' => 'cost-estimate-creator',
        //     'title' => 'Cost Estimates Creator',
        // ]);

        // $cost_estimate_reviewer = Bouncer::role()->firstOrCreate([
        //     'name' => 'cost-estimate-reviewer',
        //     'title' => 'Cost Estimates Reviewer',
        // ]);


        // $cost_estimate_approver = Bouncer::role()->firstOrCreate([
        //     'name' => 'cost-estimate-approver',
        //     'title' => 'Cost Estimate Approver'
        // ]);

        // $cost_estimate_clearer = Bouncer::role()->firstOrCreate([
        //     'name' => 'cost-estimate-clearer',
        //     'title' => 'Cost Estimate Clearer'
        // ]);

        // Bouncer::allow($cost_estimate_creator)->to([$view_cost_estimates, $create_cost_estimates]);
        // Bouncer::allow($cost_estimate_reviewer)->to([$view_cost_estimates, $create_cost_estimates, $edit_cost_estimates, $delete_cost_estimates, $review_cost_estimates, $return_cost_estimates, $reject_cost_estimates]);
        // Bouncer::allow($cost_estimate_approver)->to([$view_cost_estimates, $create_cost_estimates, $edit_cost_estimates, $delete_cost_estimates, $approve_cost_estimates, $return_cost_estimates, $reject_cost_estimates]);
        // Bouncer::allow($cost_estimate_clearer)->to([$view_cost_estimates, $create_cost_estimates, $edit_cost_estimates, $clear_cost_estimates, $review_cost_estimates, $return_cost_estimates, $reject_cost_estimates]);
        

        Bouncer::allow('cost-estimate-creator')->to('Create', CostEstimate::class);
    }
}
