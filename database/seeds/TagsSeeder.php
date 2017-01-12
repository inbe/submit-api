<?php

use Illuminate\Database\Seeder;
use \App\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = Tag::create(['name' => 'Total world domination']);
        $tag = Tag::create(['name' => 'Gringo']);
        $tag = Tag::create(['name' => 'Incrible']);
    }
}
