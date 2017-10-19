<?php

use Illuminate\Database\Seeder;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'name'=>"Бакалея"
                ],
                [
                    'name'=>"Хлебобулочные"
                ],
                [
                    'name'=>"Сладкое и дессерт"
                ],
                [
                    'name'=>"Готовые блюда"
                ],
                [
                    'name'=>"Овощи и фрукты"
                ],
                [
                    'name'=>"Молочные продукты и яйца"
                ],
                [
                    'name'=>"Мясо и рыба"
                ],
                [
                    'name'=>"Рыбные продукты и икра"
                ],
                [
                    'name'=>"Замороженные продукты"
                ],
                [
                    'name'=>"Чай и кофе"
                ],
                [
                    'name'=>"Напитки"
                ],
                [
                    'name'=>"Табак"
                ],
                [
                    'name'=>"Товары для животных"
                ],
                [
                    'name'=>"Товары для детей"
                ],
                [
                    'name'=>"Косметика гигиена"
                ],
                [
                    'name'=>"Товары для дома"
                ],
                [
                    'name'=>"Косметика и гигиена"
                ],
                [
                    'name'=>"Одежда и обувь"
                ]
            ]
        );
    }
}
