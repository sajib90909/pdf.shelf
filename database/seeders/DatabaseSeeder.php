<?php

namespace Database\Seeders;

use App\Models\Admin\File;
use Database\Seeders\Helpers\BookSeeder;
use Database\Seeders\Helpers\CategorySeeder;
use Database\Seeders\Helpers\RoleSeeder;
use Database\Seeders\Helpers\UserSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BookSeeder::class);
    }
}
