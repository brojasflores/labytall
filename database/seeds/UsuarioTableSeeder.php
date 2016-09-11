<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        	for($i = 0; $i<100; $i++)
        	{
        		\DB::table('usuario')->insert(
        			['rut' => $faker->numberBetween($min=1000000, $max=20000000),
        			 'email' => $faker->unique()->email,
        			 'nombres' => $faker->firstName,
        			 'apellidos' => $faker->lastName,
        			 'pass' => $faker->password
        			]);
        	}
    }
}
