<?php

use App\Role;
use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
