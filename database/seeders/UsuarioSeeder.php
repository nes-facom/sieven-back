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
            'name' => 'sieven', 
            'email' => 'admin@admin', 
            'email_verified_at' => NULL, 
            'password' => '$2y$10$Wj.rMPlJ8zdu6OChS1nasexv/RRl/zyre7toxOXyLV.Ry/DbxEtii', 
            'remember_token' => NULL, 
            'created_at' => '2023-05-08 18:51:34', 
            'updated_at' => '2023-05-08 18:51:34', 
            'cpf' => NULL, 
            'data_nascimento' => NULL, 
            'foto_perfil' => NULL, 
            'membro_ufms' => TRUE, 
            'administrador' => TRUE, 
            'situacao_id' => 1
        ];



        \DB::table('users')->insert($user);
    }
}