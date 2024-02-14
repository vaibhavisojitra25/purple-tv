<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'full_name' => 'Super Admin',
            'email' => 'superadmin@purplesmarttv.com',
            'phone_number' => '9999999999',
            'username' => 'SuperAdmin',
            'password' => bcrypt('admin@123')
        ]);
        $superAdmin->assignRole('SuperAdmin');

        $supportUser = User::create([
            'full_name' => 'Jasmeet',
            'email' => 'support@purplesmarttv.com',
            'phone_number' => '9428529332',
            'username' => 'purplesupport',
            'password' => bcrypt('@Amedia123')
        ]);
        $supportUser->assignRole('Support');
    }
}
