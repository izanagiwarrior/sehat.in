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
                'name' => 'Rice',
                'photo' => 'null',
            ],
            [
                'name' => 'Meatballs',
                'photo' => 'null',
            ],
            [
                'name' => 'Soto',
                'photo' => 'null',
            ],
            [
                'name' => 'Noodle',
                'photo' => 'null',
            ],
            [
                'name' => 'Satay',
                'photo' => 'null',
            ],
            [
                'name' => 'Seafood',
                'photo' => 'null',
            ],
            [
                'name' => 'Chicken',
                'photo' => 'null',
            ],
            [
                'name' => 'Duck',
                'photo' => 'null',
            ],
            [
                'name' => 'Beef',
                'photo' => 'null',
            ],
            [
                'name' => 'Pork',
                'photo' => 'null',
            ],
            [
                'name' => 'Martabak',
                'photo' => 'null',
            ],
            [
                'name' => 'Drink',
                'photo' => 'null',
            ],
            [
                'name' => 'Food',
                'photo' => 'null',
            ],
            [
                'name' => 'Coffee',
                'photo' => 'null',
            ],
            [
                'name' => 'Dessert',
                'photo' => 'null',
            ],
            [
                'name' => 'Bread',
                'photo' => 'null',
            ],
            [
                'name' => 'Cake',
                'photo' => 'null',
            ],
            [
                'name' => 'Boba',
                'photo' => 'null',
            ],
            [
                'name' => 'Snack',
                'photo' => 'null',
            ],
            [
                'name' => 'Sweet Dish',
                'photo' => 'null',
            ],
            [
                'name' => 'Italian Cuisine',
                'photo' => 'null',
            ],
            [
                'name' => 'Japanese Cuisine',
                'photo' => 'null',
            ],
            [
                'name' => 'Indian Cuisine',
                'photo' => 'null',
            ],
            [
                'name' => 'Korean Cuisine',
                'photo' => 'null',
            ],
            [
                'name' => 'Chinese Cuisine',
                'photo' => 'null',
            ],
            [
                'name' => 'Thai Cuisine',
                'photo' => 'null',
            ],
            [
                'name' => 'Western  Cuisine',
                'photo' => 'null',
            ],
            [
                'name' => 'Fried Chicken',
                'photo' => 'null',
            ],
            [
                'name' => 'Burger',
                'photo' => 'null',
            ],
            [
                'name' => 'Pizza',
                'photo' => 'null',
            ],
            [
                'name' => 'Pasta',
                'photo' => 'null',
            ],
            [
                'name' => 'Others',
                'photo' => 'null',
            ],
        ];

        foreach ($category as $key => $value) {
            Category::create($value);
        }
    }
}
