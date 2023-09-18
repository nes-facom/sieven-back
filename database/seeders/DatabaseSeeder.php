<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriaSeeder::class);
        $this->call(TipoSeeder::class);
        $this->call(ModalidadeSeeder::class);
        $this->call(UsuarioSeeder::class);
    }
}


//php artisan db:seed para executar o script