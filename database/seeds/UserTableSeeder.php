<?php

use Illuminate\Database\Seeder;
use App\User;

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
        $u1 -> username = "kevp99";
        $u1 -> password = "1234567890";
        $u1 -> realName = "Kevin Pan";
        $u1 -> dateOfBirth = "1999-02-02";
        $u1 -> bio = "Hi everybody";
        $u1 -> numberOfPosts = 5;
        $u1 -> save();*/

        //Generates 10 users using the user factory
        factory(App\User::class,10)->create();
    }
}
