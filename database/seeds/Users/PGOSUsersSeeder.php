<?php

use Illuminate\Database\Seeder;
use App\User;
class PGOSUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        // tin.aquino.pdem@gmail.com
        $tin_aquino = User::create([
            'last_name' => "Aquino",
            'first_name' => "Kristine",
            'middle_name' => "Cruz",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'tin.aquino@pd.com',
            'pd_gmail' => 'tin.aquino@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "Senior Accounts Manager",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        // Roles


        $mitch_arcilla = User::create([
            'last_name' => "Arcilla",
            'first_name' => "Michelle",
            'middle_name' => "Sabanal",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'mitch.arcilla@pd.com',
            'pd_gmail' => 'mitch.arcilla@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "Head of Accounts & Biz Development",
                    "job_level" => "1A"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        $mitch_arcilla->assign("account-creator");
        $mitch_arcilla->assign("project-assigner");
        $mitch_arcilla->assign("erfp-reviewer");

        // bautista_mikaella@projectduoevents.com

        $bautista_mikaella = User::create([
            'last_name' => "Bautista",
            'first_name' => "Mikaela Mona",
            'middle_name' => "C",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'mikaella.bautista@pd.com',
            'pd_gmail' => 'mikaella.bautista@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);
        
        $bautista_mikaella->assign('rfp-rfp-approver');

        $bicol_maria = User::create([
            'last_name' => "Bicol",
            'first_name' => "Maria Ayra Del",
            'middle_name' => "NA",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'ayradel.bicol@pd.com',
            'pd_gmail' => 'ayradel.bicol@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        $borcena_brenda = User::create([
            'last_name' => "Borcena",
            'first_name' => "Brenda",
            'middle_name' => "Valverde",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'brenda.borcena@pd.com',
            'pd_gmail' => 'brenda.borcena@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        $borcena_brenda->assign('rfp-validator');

        $bualong_john = User::create([
            'last_name' => "Bulaong",
            'first_name' => "John Paul",
            'middle_name' => "G",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'bulaong.johnpaul@pd.com',
            'pd_gmail' => 'bulaong.johnpaul@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        $bualong_john->assign('rfp-payment-approver');

        $gigi_corpuz = User::create([
            'last_name' => "Corpuz",
            'first_name' => "Jessica",
            'middle_name' => "Dela Cruz",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'gigi.corpuz@pd.com',
            'pd_gmail' => 'gigi.corpuz@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "Project Execution Head",
                    "job_level" => "1A"
                ]
            ],
            'password' => Hash::make("password")
        ]);
        
        $gigi_corpuz->assign('project-assigner');
        $gigi_corpuz->assign('budget-request-reviewer');
        $gigi_corpuz->assign('rfp-reviewer');

        
        $corral_mary = User::create([
            'last_name' => "Corral",
            'first_name' => "Mary-Ann",
            'middle_name' => "Nieva",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'meann.corral@pd.com',
            'pd_gmail' => 'meann.corral@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);
        
        $corral_mary->assign('budget-request-approver');
        $corral_mary->assign('rfp-disburser');

        User::create([
            'last_name' => "Dano",
            'first_name' => "Patricia",
            'middle_name' => "David",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'pat.dano@pd.com',
            'pd_gmail' => 'pat.dano@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        User::create([
            'last_name' => "Flores",
            'first_name' => "Justin Oliver",
            'middle_name' => "German",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'justin.flores@pd.com',
            'pd_gmail' => 'justin.flores@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        User::create([
            'last_name' => "Gelle",
            'first_name' => "Arriane Sarah",
            'middle_name' => "C",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'gelle.arriane@pd.com',
            'pd_gmail' => 'gelle.arriane@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        User::create([
            'last_name' => "Gequillana",
            'first_name' => "Torie Jonnas",
            'middle_name' => "Sulit",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'torie.gequillana@pd.com',
            'pd_gmail' => 'torie.gequillana@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        User::create([
            'last_name' => "Mazo",
            'first_name' => "Andrea Nicole",
            'middle_name' => "Torres",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'andi.mazo@pd.com',
            'pd_gmail' => 'andi.mazo@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        User::create([
            'last_name' => "Mendoza",
            'first_name' => "Julie Anne",
            'middle_name' => "Ingao",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'julie.mendoza@pd.com',
            'pd_gmail' => 'julie.mendoza@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        $elvin_olano = User::create([
            'last_name' => "Olano",
            'first_name' => "Elvin",
            'middle_name' => "Aragon",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'elvin.olano@pd.com',
            'pd_gmail' => 'elvin.olano@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "Sales and Operations Director",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        $elvin_olano->assign('account-creator');
        $elvin_olano->assign('cost-estimate-reviewer');
        $elvin_olano->assign('project-creator');
        $elvin_olano->assign('budget-request-reviewer');
        $elvin_olano->assign('erfp-reviewer');

        $victor_padojinog = User::create([
            'last_name' => "Padojinog",
            'first_name' => "Victor Jr.",
            'middle_name' => "Alcaraz",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'victor.padojinog@pd.com',
            'pd_gmail' => 'victor.padojinog@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "Project Manager",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        $victor_padojinog->assign('erfp-creator');

        $paredes_mabel = User::create([
            'last_name' => "Paredes",
            'first_name' => "Mabel Ann",
            'middle_name' => "Ruedas",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'mabel.ruedas@pd.com',
            'pd_gmail' => 'mabel.ruedas@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "Associate CD - Copy and Digital",
                    "job_level" => "1A"
                ],
                (object)[
                    "name" => "Associate CD - Design and Multimedia",
                    "job_level" => "1A"
                ]
            ],
            'password' => Hash::make("password")
        ]);

        $paredes_mabel->assign('project-assigner');

        User::create([
            'last_name' => "Reyes",
            'first_name' => "Maria Irish",
            'middle_name' => "America",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'irish.reyes@pd.com',
            'pd_gmail' => 'irish.reyes@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);

        User::create([
            'last_name' => "Sta. Ana",
            'first_name' => "Miguel",
            'middle_name' => "C",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'miguel.staana@pd.com',
            'pd_gmail' => 'miguel.staana@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);
    }
}
