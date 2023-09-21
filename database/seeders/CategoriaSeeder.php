<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $categorias = [
            [
                'nome_categoria' => 'Ciências Exatas e da Terra'
            ],
            [
                'nome_categoria' => 'Ciências Biológicas'
            ],
            [
                'nome_categoria' => 'Ciências da Saúde'
            ], 
            [
                'nome_categoria' => 'Ciências Agrárias'
            ],
            [
                'nome_categoria' => 'Ciências Sociais Aplicadas'
            ],
            [
                'nome_categoria' => 'Ciências Humanas'
            ],
            [
                'nome_categoria' => 'Linguística, Letras e Artes'
            ],
        ];



        \DB::table('categoria')->insert($categorias);
    }
}