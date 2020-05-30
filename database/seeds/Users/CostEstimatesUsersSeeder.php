<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
class CostEstimatesUsersSeeder extends Seeder
{
    use SeedsTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviewers = [
            (object)[
                "last_name" => "Olano",
                "first_name" => "Elvin",
                "middle_name" => "Aragon",
                "mail" => "elvin.olano"
            ],
        ];

        $approvers = [
            (object)[
                "last_name" => "Arcilla",
                "first_name" => "Robbie Boy",
                "middle_name" => "De Guzman",
                "mail" => "biboy.arcilla"
            ]
        ];

        $clearers = [
            (object)[
                "last_name" => "Mauleon",
                "first_name" => "Von Aaron",
                "middle_name" => "Torres",
                "mail" => "von.mauleon"
            ]
        ];

        $this->createUsers("cost-estimate-reviewer", $reviewers);
        $this->createUsers("cost-estimate-approver", $approvers);
        $this->createUsers("cost-estimate-clearer", $clearers);
        
    }
}
