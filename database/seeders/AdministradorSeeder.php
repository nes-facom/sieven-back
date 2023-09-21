<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $administradores = [
            [
                'passaporte' => 'brunno.lewin'
            ],
            [
                'passaporte' => 'camila_garcia'
            ],
            [
                'passaporte' => 'joao_brigido'
            ], 
            [
                'passaporte' => 'giovana.valli'
            ],
            [
                'passaporte' => 'arthur.cabral'
            ],
            [
                'passaporte' => 'larissa.leal'
            ],
        ];



        \DB::table('administradors')->insert($administradores);
    }
}