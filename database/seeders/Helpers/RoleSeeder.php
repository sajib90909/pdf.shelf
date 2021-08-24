<?php

namespace Database\Seeders\Helpers;

use App\Models\Administration\Role;
use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('roles');

        Role::query()->insert([
            [
                'name' => 'user',
                'alias' => 'user',
            ],[
                'name' => 'admin',
                'alias' => 'admin',
            ]
        ]);

    }
}
