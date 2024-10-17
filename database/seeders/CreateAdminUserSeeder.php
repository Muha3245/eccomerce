<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;



class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run()

        {

            $user = User::create([
                'name' => 'life',
                'email' => 'Myadmin@gmail.com',
                'password' => bcrypt('123456')

            ]);
            $role = Role::create(['id'=>1,'name' => 'superadmin','guard_name'=>'web']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);

        }
    }

