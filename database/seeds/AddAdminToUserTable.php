<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddAdminToUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $adminRole = Role::firstOrCreate(['role' => 'admin']);

        $user->name = 'Felix';
        $user->email = config('skillbox.my_email');
        $user->password = Hash::make(config('skillbox.my_password'));
        $user->save();
        $user->roles()->attach($adminRole);
    }
}
