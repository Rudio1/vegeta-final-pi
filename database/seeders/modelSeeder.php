<?php

namespace Database\Seeders;

use App\Models\modelProduct;
use Illuminate\Database\Seeder;

class modelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelDecode = '[
            {
                "name": "teste1"
            },
            {
                "name": "teste2"
            },
            {
                "name": "teste3"
            },
            {
                "name": "teste4"
            }
        ]';

        $models = json_decode($modelDecode);

        foreach ($models as $model) {
            modelProduct::updateOrCreate(['name'=>$model->name]);
        }
    }
}
