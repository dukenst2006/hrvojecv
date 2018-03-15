<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name' => 'Hrvoje',
                'email' => 'email',
                'password' => bcrypt('pass'),
                'role' => 'admin',
                'hash' => 'I1uXN5swEk6cV9l',
                'address' => 'Donji Miholjac, CRO',
                'company' => ''
            ]
        ];

        foreach($items as $item) 
        {
            User::create($item);
        }
    }
}
