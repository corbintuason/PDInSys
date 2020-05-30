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
           $creators = [
            (object)[
                "last_name" => "Olano",
                "first_name" => "Elvin",
                "middle_name" => "Aragon",
                "mail" => "elvin.olano",
                "positions" => ""
            ]
        ];

        $reviewers = [
            (object)[
                "last_name" => "Arcilla",
                "first_name" => "Robbie Boy",
                "middle_name" => "De Guzman",
                "mail" => "biboy.arcilla",
                "positions" => ""

            ]
        ];

        $approvers = [
            (object)[
                "last_name" => "Mauleon",
                "first_name" => "Von Aaron",
                "middle_name" => "Torres",
                "mail" => "von.mauleon",
                "positions" => ""

            ]
        ];

        $assigners = [
            (object)[
                "last_name" => "Arcilla",
                "first_name" => "Michelle",
                "middle_name" => "Sabanal",
                "mail" => "mitch.arcilla",
                "positions" => ""

            ],
            (object)[
                "last_name" => "Corpuz",
                "first_name" => "Jesica",
                "middle_name" => "",
                "mail" => "gigi.corpuz",
                "positions" => [
                    (object)[
                        "name" => "Project Execution Head",
                        "job_level" => "1A"
                    ]
                ]
            ],
            (object)[
                "last_name" => "Paredes",
                "first_name" => "Mabel Ann",
                "middle_name" => "Ruedas",
                "mail" => "mabel.ruedas",
                "positions" => [
                    (object)[
                        "name" => "Associate CD - Copy and Digital",
                        "job_level" => "1A"
                    ],
                    (object)[
                        "name" => "Associate CD - Design and Multimedia",
                        "job_level" => "1A"
                    ]
                ]
            ]
        ];

        $this->createUsers("project-creator", $creators);
        $this->createUsers("project-reviewer", $reviewers);
        $this->createUsers("project-approver", $approvers);
        $this->createUsers("project-assigner", $assigners);
    }
}
