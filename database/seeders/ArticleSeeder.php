<?php

namespace Database\Seeders;

use App\Models\Article;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->ezData();
    }

    private function ezData() {
        Article::create([
            'user_id' => 1,
            'title' => Factory::create()->title,
            'description' => Factory::create()->paragraph,
        ]);

        Article::create([
            'user_id' => 1,
            'title' => Factory::create()->title,
            'description' => Factory::create()->paragraph,
        ]);
    }
}
