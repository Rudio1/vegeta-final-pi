<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $linksyt = '[
            {
                "name":"Narciso Delay",
                "price":1447.00,
                "description":"Um delay stereo de alta qualidade com uma ampla gama de op\u00e7\u00f5es de personaliza\u00e7\u00e3o para dar ao seu som a ambi\u00eancia perfeita. Com quatros modos de delays diferentes, voc\u00ea pode escolher desde um cl\u00e1ssico delay anal\u00f3gico at\u00e9 um delay com pitch bem psicod\u00e9lico.",
                "product_image":"storage\/app\/pedalUm.jpg",
                "link_yt" : "https://www.youtube.com/watch?v=hFq0ho1UbTs ",
                "link_manual" : "https://vtreffects.com.br/narciso-delay-gold-series-manual/", 
                "link_driver" : "https://drive.google.com/file/d/1anBilSRo4gLEfhVOFpX5oTpby4kPVHrm/view"
            },
            {
                "name":"Helios Overdrive",
                "price":1447.00,
                "description":"O Helios Overdrive \u00e9 um pedal de overdrive anal\u00f3gico com recursos digitais avan\u00e7ados. Com uma ampla gama de op\u00e7\u00f5es de personaliza\u00e7\u00e3o, oferece o timbre perfeito para seu som. Desde sutis satura\u00e7\u00f5es at\u00e9 drives intensos, o Helios proporciona uma resposta din\u00e2mica e org\u00e2nica. Com recursos \u00fanicos e versatilidade excepcional, \u00e9 o pedal de overdrive ideal para elevar sua express\u00e3o musical.",
                "product_image":"storage\/app\/pedalDois.jpg",
                "link_yt" : "https://www.youtube.com/watch?v=P97v6RF0lF8",
                "link_manual" : "https://vtreffects.com.br/helios-overdrive-gold-series-manual/", 
                "link_driver" : "https://drive.google.com/file/d/1lyDpKn2vs91WB1E-Di8Tx1sTsJqyjaqX/view"
            },
            {
                "name":"Kailani Reverb",
                "price":1447.00,
                "description":"Um reverb stereo de alta qualidade com uma ampla gama de op\u00e7\u00f5es de personaliza\u00e7\u00e3o para dar ao seu som a ambi\u00eancia perfeita. Com oito modos de reverb diferentes, voc\u00ea pode escolher desde um ambiente natural e espa\u00e7oso at\u00e9 um efeito denso e imersivo.",
                "product_image":"storage\/app\/pedalTres.jpg",
                "link_yt" : "https://www.youtube.com/watch?v=bZEg7Dvsf4k ",
                "link_manual" : "https://vtreffects.com.br/kailani-reverb-gold-series-manual/", 
                "link_driver" : "https://drive.google.com/file/d/1aj5uPvgii3burNqC8QrDbq_C_sqK62p3/view"
            }
        ]';
        $links = json_decode($linksyt);

        foreach ($links as $link) {
            Product::updateOrCreate(
                [
                    'name' => $link->name,
                    'price' => $link->price,
                    'description' => $link->description,
                    'product_image' => $link->product_image,
                    'link_yt' => $link->link_yt,
                    'link_manual' => $link->link_manual,
                    'link_driver' => $link->link_driver,
                ]
            );
        }
    }
}
