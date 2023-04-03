<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorias;

class CategoriasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriasJson = '[
            {
                "nome": "Sugestão"
            },
            {
                "nome": "Solicitação de Garantia"
            },
            {
                "nome": "Dúvidas"
            },
            {
                "nome": "Problemas estruturais"
            },
            {
                "nome": "Problemas com software"
            },
            {
                "nome": "Problemas do APP"
            },
            {
                "nome": "Outros"
            }
        ]';

        $categorias = json_decode($categoriasJson);

        foreach ($categorias as $categoria) {
            Categorias::updateOrCreate(
                ['nome' => $categoria->nome]
            );
        }
    }
}
