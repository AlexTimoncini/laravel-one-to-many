<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Type;


class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $types = ['html', 'css', 'bootstrap', 'javascript', 'vue', 'vite', 'axios', 'php', 'laravel', 'eloquent', 'scss'];
        foreach ($types as $type) { 
            $newType = new Type();
            $newType->name = $type;
            $newType->color = $faker->hexColor();
            $newType->documentation = $faker->url();
            $newType->save();
        }
    }
}
