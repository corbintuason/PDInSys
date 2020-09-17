<?php

use Illuminate\Database\Seeder;
use App\Vendor;

class VendorModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // VAT Registered
        Vendor::create([
            "vendor_name" => "PILIPINAS SHELL PETROLEUM CORPORATION",
            "trade_name" => "PILIPINAS SHELL PETROLEUM CORPORATION",
            "registered_address" => (object)[
                "first_address" => "41ST FLOOR THE FINANCE CENTER, 26TH ST COR 9TH AVENUE",
                "brgy" => "Fort Bonifacio",
                "city" => "Taguig",
                "province" => "NCR",
                "zip_code" => 1634,
            ],
            "type_business" => "Corporation",
            "line_business" => "Both",
            "contact_person" => (object)[
                "last_name" => "Morales",
                "first_name" => "Katrina Mae",
                "middle_name" => "Geronimo"
            ],
            "contact_number" => "09289921274",
            "email_address" => "katrinamae@gmail.com",
            "bank_details" => [
                (object)[
                        "bank_name" => "SCB (Standard Chartered Bank)",
                        "bank_address" => (object)[
                            "bank_branch" => "6788 Ayala Ave, Legazpi Village, Makati, 1226 Metro Manila, Philippines",
                            "bank_city" => null
                        ],
                        "account_name" => "PILIPINAS SHELL PETROLEUM CORPORATION",
                        "account_number" => "146335516474",
                        "status" => "Active"
                    ],
                    (object)[
                        "bank_name" => "Alternate",
                        "bank_address" => (object)[
                            "bank_branch" => "6788 Ayala Ave, Legazpi Village, Makati, 1226 Metro Manila, Philippines",
                            "bank_city" => null
                        ],
                        "account_name" => "PILIPINAS SHELL PETROLEUM CORPORATION ALTERNATE",
                        "account_number" => "146335516474",
                        "status" => "Active"
                    ],
            ],
            "tin_number" => "000-164-757-00000",
            "type_vat" => "VAT Registered",
            "ewt_details" => [
                (object)[
                    "name" => "WC158",
                    "description" => "Income Payment made by top withholding agents to their local/resident suppliers of GOODS other than those covered by other rates of withholding tax",
                    "percent" => 0.01
                ],
            ],
            "status" => "Approved"



        ]);

        // NON-VAT Registered
        Vendor::create([
            "vendor_name" => "CHATEAU VERDE CONDOMINIUM CORP",
            "trade_name" => "CHATEAU VERDE CONDOMINIUM CORP",
            "registered_address" => (object)[
                "first_address" => "CHATEAU VERDE CONDO E RODRIGUEZ JR AVE",
                "brgy" => "UGONG",
                "city" => "PASIG",
                "province" => "NCR",
                "zip_code" => 1605,
            ],
            "type_business" => "Corporation",
            "line_business" => "Services",
            "contact_person" => (object)[
                "last_name" => "Miranda",
                "first_name" => "Merlyn",
                "middle_name" => "H"
            ],
            "contact_number" => "(02)8-671-2335",
            "email_address" => "chateauverde@yahoo.com",
            "bank_details" => [
                (object)[
                    "bank_name" => "SB (Security Bank)",
                    "bank_address" => (object)[
                        "bank_branch" => "Valle Verde",
                        "bank_city" => null
                    ],
                    "account_name" => "Chateau Verde Condominium Corporation",
                    "account_number" => "0000010846741"
                ]
 
            ],
            "tin_number" => "002-787-544-00000",
            "type_vat" => "NON-VAT Registered",
            "ewt_details" => [
                (object)[
                    "name" => "WC160",
                    "description" => "Income Payment made by top withholding agents to their local/resident suppliers of services other than those covered by other rates of withholding tax",
                    "percent" => 0.02
                ],
            ],
            "status" => "Approved"
        ]);

        // Not Registered
        Vendor::create([
            "vendor_name" => "SIOSON, MARIANNA S.",
            "trade_name" => "SIOSON, MARIANNA S.",
            "registered_address" => (object)[
                "first_address" => "10 GARFIELD STREET",
                "brgy" => "",
                "city" => "SAN JUAN CITY",
                "province" => "NCR",
                "zip_code" => 1500,
            ],
            "type_business" => "Not Registered",
            "line_business" => "Services",
            "type_business" => "Not Registered",
            "contact_person" => (object)[
                "last_name" => "SIOSON",
                "first_name" => "MARIANNA",
                "middle_name" => "S"
            ],
            "contact_number" => "",
            "email_address" => "",
            "tin_number" => "188-083-331-00000",
            "type_vat" => "Not Registered",

            "bank_details" => [
                (object)[
                    "bank_name" => "SB (Security Bank)",
                    "bank_address" => (object)[
                        "bank_branch" => "",
                        "bank_city" => null
                    ],
                    "account_name" => "MARI JT SIOSON",
                    "account_number" => "0382473958001"
                ]
            ],
            "ewt_details" => [
                (object)[
                    "name" => "WI120",
                    "description" => "Income Payment made by top withholding agents to their local/resident suppliers of services other than those covered by other rates of withholding tax",
                    "percent" => 0.02
                ],
            ],
            "status" => "Approved"
        ]);
    }
    
}
