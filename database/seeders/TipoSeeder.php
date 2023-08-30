<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $tipos = [
            [
                'nome_tipo' => 'Conferências'
            ],
            [
                'nome_tipo' => 'Seminários'
            ],
            [
                'nome_tipo' => 'Congressos'
            ], 
            [
                'nome_tipo' => 'Workshops'
            ],
            [
                'nome_tipo' => 'Palestras'
            ],
            [
                'nome_tipo' => 'Culturais'
            ],
            [
                'nome_tipo' => 'Esportivos'
            ],
        ];



        \DB::table('tipo')->insert($tipos);
    }
}