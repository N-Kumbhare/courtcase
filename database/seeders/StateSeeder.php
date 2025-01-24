<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert(['StateName' => 'Telangana','StCode' => '32']);
        DB::table('states')->insert(['StateName' => 'Uttar Pradesh','StCode' => '34']);
        DB::table('states')->insert(['StateName' => 'Maharashtra','StCode' => '21']);
        DB::table('states')->insert(['StateName' => 'Gujarat','StCode' => '12']);
        DB::table('states')->insert(['StateName' => 'Mizoram','StCode' => '24']);
        DB::table('states')->insert(['StateName' => 'Rajasthan','StCode' => '29']);
        DB::table('states')->insert(['StateName' => 'Kerala','StCode' => '18']);
        DB::table('states')->insert(['StateName' => 'Uttarakhand','StCode' => '35']);
        DB::table('states')->insert(['StateName' => 'Andhra Pradesh','StCode' => '2']);
        DB::table('states')->insert(['StateName' => 'Haryana','StCode' => '13']);
        DB::table('states')->insert(['StateName' => 'Punjab','StCode' => '28']);
        DB::table('states')->insert(['StateName' => 'Jammu & Kashmir','StCode' => '15']);
        DB::table('states')->insert(['StateName' => 'TamilNadu','StCode' => '31']);
        DB::table('states')->insert(['StateName' => 'West Bengal','StCode' => '36']);
        DB::table('states')->insert(['StateName' => 'Odisha','StCode' => '26']);
        DB::table('states')->insert(['StateName' => 'Bihar','StCode' => '5']);
        DB::table('states')->insert(['StateName' => 'Karnataka','StCode' => '17']);
        DB::table('states')->insert(['StateName' => 'Madhya Pradesh','StCode' => '20']);
        DB::table('states')->insert(['StateName' => 'Assam','StCode' => '4']);
        DB::table('states')->insert(['StateName' => 'Chattisgarh','StCode' => '7']);
        DB::table('states')->insert(['StateName' => 'Manipur','StCode' => '22']);
        DB::table('states')->insert(['StateName' => 'Andaman & Nicobar Islands','StCode' => '1']);
        DB::table('states')->insert(['StateName' => 'Himachal Pradesh','StCode' => '14']);
        DB::table('states')->insert(['StateName' => 'Chandigarh','StCode' => '6']);
        DB::table('states')->insert(['StateName' => 'Arunachal Pradesh','StCode' => '3']);
        DB::table('states')->insert(['StateName' => 'Dadra & Nagar Haveli','StCode' => '8']);
        DB::table('states')->insert(['StateName' => 'Daman & Diu','StCode' => '9']);
        DB::table('states')->insert(['StateName' => 'Delhi','StCode' => '10']);
        DB::table('states')->insert(['StateName' => 'Tripura','StCode' => '33']);
        DB::table('states')->insert(['StateName' => 'Jharkhand','StCode' => '16']);
        DB::table('states')->insert(['StateName' => 'Nagaland','StCode' => '25']);
        DB::table('states')->insert(['StateName' => 'Meghalaya','StCode' => '23']);
        DB::table('states')->insert(['StateName' => 'Sikkim','StCode' => '30']);
        DB::table('states')->insert(['StateName' => 'Goa','StCode' => '11']);
        DB::table('states')->insert(['StateName' => 'Poducherry','StCode' => '27']);
        DB::table('states')->insert(['StateName' => 'Lakshadweep','StCode' => '19']);
    }
}
