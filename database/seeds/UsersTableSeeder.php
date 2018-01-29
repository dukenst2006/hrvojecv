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
                'name' => 'hrvoje',
                'email' => 'admin@admin.hr',
                'password' => bcrypt('admin1708'),
                'role' => 'admin',
                'hash' => str_random(15),
                'address' => 'Donji Miholjac, CRO',
                'company' => 'Test d.o.o.'
            ],
            [
                'name' => 'guest',
                'email' => 'user@user.hr',
                'password' => bcrypt('user1708'),
                'role' => 'user',
                'hash' => str_random(15),
                'address' => 'Cork, IE',
                'company' => 'Guest d.o.o.'
            ]
        ];

        foreach($items as $item) 
        {
            User::create($item);
        }
    }
}
