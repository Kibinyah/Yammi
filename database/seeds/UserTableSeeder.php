<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dummy seed
        /*$u1 = new User;
        $u1 -> username = "kibinyah";
        $u1 -> password = "12345678";
        $u1 -> email = "kevinwingchunpan@gmail.com";
        $u1 -> save();
*/

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();

        $admin = User::create([
            'username' => "admin user",
            'email' => "admin@admin.com",
            'password' => Hash::make('12345678'),
        ]);

        $admin->roles()->attach($adminRole);
        //Generates 10 users using the user factory
        factory(App\User::class,10)->create();
    }
}
