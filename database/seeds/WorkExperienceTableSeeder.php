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
    		'address' => 'Svetog L.B.Mandića 111o',
    		'position' => 'PHP Backend Developer',
    		'work_from' => '23.7.2017.',
    		'work_to' => '31.1.2018.',
    		'desc' => 'PHP5/7 with Laravel/Symfony Frameworks. Experience with MySQL, MAMP/LAMP stack, API, JSON, AJAX, MCV, OOP and also UI - HTML5/CSS3, jQuery, Bootstrap, Responsive design.',
    		'currently_employed' => true
    	]);
    }
}
