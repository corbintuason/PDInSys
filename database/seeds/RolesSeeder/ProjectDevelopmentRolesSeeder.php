<?php

use Illuminate\Database\Seeder;
use App\Project;
class ProjectDevelopmentRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // Role Creation
        $project_creator = Bouncer::role()->firstOrCreate([
            'name' => 'project-creator',
            'title' => 'Creator',
            'entity' => Project::class
        ]);

        $project_reviewer = Bouncer::role()->firstOrCreate([
            'name' => 'project-reviewer',
            'title' => 'Reviewer',
            'entity' => Project::class
        ]);


        $project_approver = Bouncer::role()->firstOrCreate([
            'name' => 'project-approver',
            'title' => 'Approver',
            'entity' => Project::class
        ]);

        $project_assigner = Bouncer::role()->firstOrCreate([
            'name' => 'project-assigner',
            'title' => 'Assigner',
            'entity' => Project::class
        ]);
        
        Bouncer::allow($project_creator)->to(['view-all', 'view', 'create'], Project::class);
        Bouncer::allow($project_reviewer)->to(['view-all', 'view', 'create', 'review'], Project::class);
        Bouncer::allow($project_approver)->to(['view-all', 'view', 'create', 'approve'], Project::class);
        Bouncer::allow($project_assigner)->to(['view-all', 'view', 'assign'], Project::class);
    }
}
