<?php

use Illuminate\Database\Seeder;
use App\Models\Unidade;

class UnidadeDefaultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->delete();
        Unidade::create([
            'nome' => 'Conselho Normativas', 
            'tipo' => 'Conselho', 
            'esfera' => 'Estadual',
            'email' => 'cfnormativas@normativas.com.br',
            'url' => 'http://normativas.nees.com.br',
            'sigla' => 'NBR',
            'contato' => 'João Normativas',
            'telefone' => '(82)9999-9999',
            'responsavel_id' => '1',
            'user_id' => '1',
        ]);
       
    }
}
