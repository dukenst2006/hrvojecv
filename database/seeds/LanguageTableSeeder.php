<?php

use App\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
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
               	'title' => 'English',
                'understanding' => 'C1',
                'speach' => 'C1',
                'writing' => 'C1'
            ],
            [
                'title' => 'German',
                'understanding' => 'A1',
                'speach' => 'A1',
                'writing' => 'A2'
            ]
        ];

        foreach($items as $item) 
        {
            Language::create($item);
        }
    }
}
