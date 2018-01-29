<?php

use App\Education;
use Illuminate\Database\Seeder;

class EducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
               	'institute' => 'Srednja Škola Donji Miholjac',
                'title' => 'Komercijalist',
                'period' => '2006. - 2010.',
                'add_info' => '',
                'accomplishments' => ''
            ],
            [
                'institute' => 'POU Nova Gradiška',
                'title' => 'Prometni tehničar',
                'period' => '2015. - 2016.',
                'add_info' => 'Profesionalni vozač kamiona s KOD95',
                'accomplishments' => ''
            ]
        ];

        foreach($items as $item) 
        {
            Education::create($item);
        }
    }
}
