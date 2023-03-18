<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ["librarian" ,"reader"];

        foreach ($roles as $key => $value) {
            $role = new Role();
            $role->name = $value;
            $role->save();
        }
    }
}
