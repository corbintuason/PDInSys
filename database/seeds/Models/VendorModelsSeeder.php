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
            "bank_details" => (object)[
                "bank_name" => "SCB (Standard Chartered Bank)",
                "bank_address" => (object)[
                    "bank_branch" => "6788 Ayala Ave, Legazpi Village, Makati, 1226 Metro Manila, Philippines",
                    "bank_city" => null
                ],
                "account_name" => "PILIPINAS SHELL PETROLEUM CORPORATION",
                "account_number" => "146335516474"
            ],
            "tin_number" => "000-164-757-00000",
            "type_vat" => "VAT",
            "ewt_details" => [
                (object)[
                    "name" => "WC158",
                    "description" => "Income Payment made by top withholding agents to their local/resident suppliers of GOODS other than those covered by other rates of withholding tax",
                    "percent" => 0.01
                ],
            ],
            "status" => "Approved"



            /**
             * 
             * [{"detail":{
             * "name":"WI051","description":"Management and technical consultants - if gross income is more than 3M or VAT registered regardless of amount","percent":"10%"}}]
             */
        ]);
    }
}
