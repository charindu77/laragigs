<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $user = User::factory()->create([
        //     'name'=> 'Jon Doe',
        //     'email'=>'jon@gmail.com',
        //     'password' =>'123123123'
        // ]);

        Listing::factory(1000)->create([
            'user_id' => User::factory()->create([
                'password' => 'password'
            ])
        ]);
    }
}