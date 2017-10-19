<?php

use Illuminate\Database\Seeder;

class ShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert(
            [
                [
                    'name'=>"ATB",
                    'img'=>"/images/atb-small.png",
                    'method'=>"AtbParser"
                ],
                [
                    'name'=>"Сильпо",
                    'img'=>"/images/silpo-small.png",
                    'method'=>"SilpoParser"
                ],
                [
                    'name'=>"Класс",
                    'img'=>"/images/klass-small.png",
                    'method'=>"KlassParser"
                ],
                [
                    'name'=>"Посад",
                    'img'=>"/images/posad-small.png",
                    'method'=>"PosadParser"
                ],
                [
                    'name'=>"Брусничка",
                    'img'=>"/images/brusnichka-small.png",
                    'method'=>"BrusnichkaParser"
                ],
                [
                    'name'=>"Velmarket",
                    'img'=>"/images/velmart-small.png",
                    'method'=>"VelmarketParser"
                ],
                [
                    'name'=>"Таврия B",
                    'img'=>"/images/tavria-small.png",
                    'method'=>"TavriaParser"
                ],
                [
                    'name'=>"Okwine",
                    'img'=>"/images/okwine-small.png",
                    'method'=>"OkwineParser"
                ],
                [
                    'name'=>"Антошка",
                    'img'=>"/images/antoshka-small.png",
                    'method'=>"AntoshkaParser"
                ]
            ]
        );
    }
}
