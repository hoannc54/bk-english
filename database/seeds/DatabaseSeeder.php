<?php
//câu lệnh php artisan migrate:refresh --seed
use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
//		Model::unguard();
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12344321'),
            'level' => 1
        ]);
        // $this->call('UserTableSeeder');
    }

}
