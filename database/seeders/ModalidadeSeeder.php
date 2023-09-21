<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $modalidades = [
            [
                'nome_modalidade' => 'Presencial'
            ],
            [
                'nome_modalidade' => 'Híbrido'
            ],
            [
                'nome_modalidade' => 'Remoto/Online'
            ], 
        ];



        \DB::table('modalidade')->insert($modalidades);
    }
}