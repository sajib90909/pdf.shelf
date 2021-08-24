<?php

namespace Database\Seeders\Helpers;

use App\Models\Admin\File;
use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncate('users');

        $this->truncate('files');

        $faker = resolve(Generator::class);

        User::query()->insert([[
            'name' => 'App Admin',
            'email' => 'admin@demo.com',
            'password' => Hash::make('123456'),
            'role_id' => 2,
            'bio' => $faker->text(200),
        ],[
            'name' => 'User Prince',
            'email' => 'user@demo.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
            'bio' => $faker->text(200),
        ]]);

        User::factory()->times(25)->create()->each(function ($user) use($faker){
            $user->profilePicture()->create([
                'type' => 'image',
                'name' => 'image',
                'path' => 'images/book/'.$faker->image('public/images/book',640,480, null, false)
            ]);
        });
    }
}
