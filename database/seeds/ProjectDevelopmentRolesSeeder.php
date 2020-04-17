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
        
        // Project List - Create Project (PROCESS FLOW - CREATE, APPROVE)

        $approve_projects = Bouncer::ability()->firstOrCreate([
            'name' => 'approve-all-projects',
            'title' => 'Approve All Projects',
        ]);

        
        // Role Creation
        $project_creator = Bouncer::role()->firstOrCreate([
            'name' => 'project-creator',
            'title' => 'Project Creator',
        ]);

        $project_approver = Bouncer::role()->firstOrCreate([
            'name' => 'project-approver',
            'title' => 'Project Approver'
        ]);

        // Assign
        Bouncer::allow($project_creator)->to([$view_projects, $create_projects]);
        Bouncer::allow($project_approver)->to([$view_projects, $create_projects, $edit_projects, $delete_projects, $approve_projects]);
    }
}
