<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
class ProjectsUsersSeeder extends Seeder
{
    use SeedsTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           // Creators
           $creators = [
            (object)[
                "last_name" => "Olano",
                "first_name" => "Elvin",
                "middle_name" => "Aragon",
                "mail" => "elvin.olano"
            ]
        ];

        $reviewers = [
            (object)[
                "last_name" => "Arcilla",
                "first_name" => "Robbie Boy",
                "middle_name" => "De Guzman",
                "mail" => "biboy.arcilla"
            ]
        ];

        $approvers = [
            (object)[
                "last_name" => "Mauleon",
                "first_name" => "Von Aaron",
                "middle_name" => "Torres",
                "mail" => "von.mauleon"
            ]
        ];

        $this->createUsers("project-creator", $creators);
        $this->createUsers("project-reviewer", $reviewers);
        $this->createUsers("project-approver", $approvers);
    }
}
