<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            'Associate',
            'Senior Associate',
            'SPOC',
            'HR',
            'Manager',
            'Team Leader',
            'Project Manager',
            'Operation Head',
            'Sales Head',
            'Supply Manager',
            'Office boy',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
