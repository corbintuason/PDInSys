<?php

use Illuminate\Database\Seeder;
use App\Project;
class ProjectModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            "name" => "LACTUM_FBLIVE",
            "start_date" => "2020-03-19",
            "end_date" => "2020-03-25",
            "locations" => ["First Location"],
            "status" => "For Assigning",
            "project_status" => "Open",
            "score" => 5,
            "for_project_bidding" => 1,
            "departments_needed" => ["test"],
            "supporting_documents" => null,
            
            "client_id" => 1,
            "department_id" => 1,
            "brand_id" => 1
        ]);
        
    }
}
