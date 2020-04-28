<?php

use Illuminate\Database\Seeder;

class ProjectDevelopmentRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $view_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'view-all-projects',
            'title' => 'View All Projects',
        ]);

        $create_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'create-projects',
            'title' => 'Create Projects',
        ]);

        $edit_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'edit-all-projects',
            'title' => 'Edit All Projects',
        ]);

        $delete_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'delete-all-projects',
            'title' => 'Delete All Projects',
        ]);
        
        // Project List - Create Project (PROCESS FLOW - CREATE, REVIEW, RETURN, REJECT, APPROVE)

        $approve_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'approve-all-projects',
            'title' => 'Approve All Projects',
        ]);
        
        $review_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'review-all-projects',
            'title' => 'Review All Projects',
        ]);

        $assign_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'assign-all-projects',
            'title' => 'Assign All Projects'
        ]);

        $reject_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'reject-all-projects',
            'title' => 'Reject All Projects'
        ]);
        
        $return_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'return-all-projects',
            'title' => 'Return all Projects'
        ]);


        
        // Role Creation
        $project_creator = Bouncer::role()->firstOrCreate([
            'name' => 'project-creator',
            'title' => 'Project Creator',
        ]);

        $project_reviewer = Bouncer::role()->firstOrCreate([
            'name' => 'project-reviewer',
            'title' => 'Project Reviewer',
        ]);


        $project_approver = Bouncer::role()->firstOrCreate([
            'name' => 'project-approver',
            'title' => 'Project Approver'
        ]);

        $project_assigner = Bouncer::role()->firstOrCreate([
            'name' => 'project-assigner',
            'title' => 'Project Assigner'
        ]);

        // Assign
        Bouncer::allow($project_creator)->to([$view_projects, $create_projects]);
        Bouncer::allow($project_reviewer)->to([$view_projects, $create_projects, $edit_projects, $delete_projects, $review_projects, $return_projects, $reject_projects]);
        Bouncer::allow($project_approver)->to([$view_projects, $create_projects, $edit_projects, $delete_projects, $review_projects, $return_projects, $reject_projects, $approve_projects]);
        Bouncer::allow($project_assigner)->to([$view_projects, $create_projects, $edit_projects, $delete_projects, $review_projects, $return_projects, $reject_projects, $approve_projects, $assign_projects]);
    }
}
