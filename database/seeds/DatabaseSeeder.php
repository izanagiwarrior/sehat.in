<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'last_name' => 'Admin',
                'roles' => 'admin',
                'email' => 'admin@sehatin.com',
                'password' => 'password',
            ],
            [
                'name' => 'example-customer',
                'last_name' => 'example-customer',
                'roles' => 'customer',
                'email' => 'customer@sehatin.com',
                'password' => 'password',
            ],
            [
                'name' => 'example-mitra',
                'last_name' => 'example-mitra',
                'roles' => 'mitra',
                'email' => 'mitra@sehatin.com',
                'password' => 'password',
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }

        $category = [
            [
                'name' => 'MAKANAN',
                'photo' => 'null',
            ],
            [
                'name' => 'MINUMAN',
                'photo' => 'null',
            ],
        ];

        foreach ($category as $key => $value) {
            Category::create($value);
        }
    }
}
