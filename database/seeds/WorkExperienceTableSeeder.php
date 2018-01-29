<?php

use Illuminate\Database\Seeder;

class WorkExperienceTableSeeder extends Seeder
{
    
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
    	DB::table('work_experiences')->insert([
    		'company' => 'Gauss d.o.o.',
    		'sector' => 'IT',
    		'address' => 'Svetog L.B.Mandića 111',
    		'position' => 'Backend developer',
    		'work_from' => '23.7.2017.',
    		'work_to' => null,
    		'desc' => 'PHP s Laravel i Symfony FW',
    		'currently_employed' => true
    	]);
    }
}
