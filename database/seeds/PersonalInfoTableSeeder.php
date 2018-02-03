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
    		'surname' => 'Zubcic',
            'position' => 'PHP Web Developer',
            'summary' => 'lorem ipsum i tako dalje',
            'key_skills' => 'PHP, Laravel, Symfony, MAMP/LAMP, JSON, AJAX, MySQL',
    		'gender' => 'M',
    		'dob' => '17.08.1991.',
    		'pob' => 'Nasice',
    		'current_residence' => 'Ivanovo',
    		'street' => 'Nikole Tesle',
    		'house_no' => 9,
    		'postcode' => 31540,
    		'state' => 'Croatia',
    		'tel' => '+38531399798',
    		'mob' => '+385976622218',
    		'email' => 'hrcamnlz@gmail.com',
    		'skype' => 'hrcamnlz@gmail.com',
    		'nationality' => 'Croatian',
    	]);
    }
}
