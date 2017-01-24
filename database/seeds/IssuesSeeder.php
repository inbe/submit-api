<?php

use Illuminate\Database\Seeder;
use \App\Issue;

class IssuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = \App\User::where('name', 'testuser')->firstOrFail()->id;
        $issue = Issue::create(['user_id' => $user_id, 'description' => 'Hello erich']);
        $issue = Issue::create(['user_id' => $user_id, 'description' => 'Hola Antwon']);
        $issue = Issue::create(['user_id' => $user_id, 'description' => 'Just an humble coder']);
    }
}
