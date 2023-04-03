<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeed extends Seeder
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
                "name": "Sugestão"
            },
            {
                "name": "Solicitação de Garantia"
            },
            {
                "name": "Dúvidas"
            },
            {
                "name": "Problemas estruturais"
            },
            {
                "name": "Problemas com software"
            },
            {
                "name": "Problemas do APP"
            },
            {
                "name": "Outros"
            }
        ]';

        $categorias = json_decode($categoriasJson);

        foreach ($categorias as $categoria) {
            Category::updateOrCreate(
                ['name' => $categoria->name]
            );
        }
    }
}
