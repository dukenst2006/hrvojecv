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
               	'institute' => 'High school Donji Miholjac',
                'title' => 'Commerce/Economy',
                'period' => '2006. - 2010.',
                'add_info' => '',
                'accomplishments' => ''
            ],
            [
                'institute' => 'POU Nova Gradiska',
                'title' => 'Traffic techician',
                'period' => '2015. - 2016.',
                'add_info' => 'Professional truck driver with CODE95',
                'accomplishments' => ''
            ]
        ];

        foreach($items as $item) 
        {
            Education::create($item);
        }
    }
}
