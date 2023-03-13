<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteContato;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SiteContato::create([
        //     'nome' => 'santhiago',
        //     'telefone' => '9999-2333',
        //     'email' => 'santhiago.monteiro@hotmail.com',
        //     'motivo_contato' => 1,
        //     'mensagem' => 'Fala mais'
        // ]); 
        
        SiteContato::factory()->count(100)->create();

    }
}
