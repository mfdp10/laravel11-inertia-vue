<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            "first_name" => "Mauricio",
            "last_name" => "Di Paolo",
            "company" => "",
            "phone" => "966727354",
            "mobile" => "626908953",
            "id_card" => "49250146Q",
            "email" => "mfdp10@gmail.com",
            "comments" => ""
        ]);
        Customer::create([
            "first_name" => "Gisela",
            "last_name" => "Formiconi",
            "company" => "",
            "phone" => "966727354",
            "mobile" => "697908953",
            "id_card" => "29250146Q",
            "email" => "gise077@gmail.com",
            "comments" => ""
        ]);
    }
}
