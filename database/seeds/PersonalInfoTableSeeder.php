<?php

use Illuminate\Database\Seeder;

class PersonalInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personal_infos')->insert([
    		'name' => 'Hrvoje',
    		'surname' => 'Zubčić',
    		'gender' => 'M',
    		'dob' => '17.08.1991.',
    		'pob' => 'Našice',
    		'current_residence' => 'Ivanovo',
    		'street' => 'Nikole Tesle',
    		'house_no' => 9,
    		'postcode' => 31540,
    		'state' => 'Hrvatska',
    		'tel' => 31399798,
    		'mob' => 976622218,
    		'email' => 'hrcamnlz@gmail.com',
    		'skype' => 'hrcamnlz@gmail.com',
    		'nationality' => 'Hrvat',
    	]);
    }
}
