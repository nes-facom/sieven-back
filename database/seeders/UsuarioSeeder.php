<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = [
            [
                'nome' => 'Administrator',
                'password' => bcrypt('admin'),
                'email' => 'admin@mail.com'
            ],
            [
                'nome' => 'Arminda',
                'password' => bcrypt('arminda'),
                'email' => 'arminda.del@ufms.br'
            ],
            [
                'nome' => 'Margarete',
                'password' => bcrypt('margarete'),
                'email' => 'margarete.knoch@gmail.com'
            ],
            [
                'nome' => 'Zuleide',
                'password' => bcrypt('zuleide'),
                'email' => 'zuleidedurey@gmail.com'
            ]
        ];



        \DB::table('users')->insert($user);
    }
}