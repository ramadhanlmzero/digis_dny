<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'sutejo',
            'email' => 'sutejo@dny.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adminsutejo'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'Admin',
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'yatmini',
            'email' => 'yatmini@dny.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adminyatmini'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'Admin',
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'tukri',
            'email' => 'tukri@dny.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admintukri'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'Distributor',
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'bikun',
            'email' => 'bikun@dny.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adminbikun'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'Distributor',
        ]);
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'lastri',
            'email' => 'lastri@dny.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adminlastri'),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'Distributor',
        ]);
    }
}
