<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Traits\SeedsTrait;
class AccountsUsersSeeder extends Seeder
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
                "mail" => "elvin.olano",
                "positions" => ""
            ],
            (object)[
                "last_name" => "Arcilla",
                "first_name" => "Michelle",
                "middle_name" => "Sabanal",
                "mail" => "mitch.arcilla",
                "positions" => [
                    (object)[
                        "name" => "Head of Accounts & Biz Development",
                        "job_level" => "1A"
                    ]
                ]
            ],
            (object)[
                "last_name" => "De Leon",
                "first_name" => "Justine Joy",
                "middle_name" => "Vinarao",
                "mail" => "justine.deleon",
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

        $this->createUsers("account-creator", $creators);
        $this->createUsers("account-approver", $approvers);
    }
}