<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Str;
use DB;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=0; $i < 5; $i++) { 
    		DB::table('tasks')->insert([
	        	'user_id'		=>	User::find(1)->id,
	        	'name'			=>	'Task ' . Str::random(5),
	        	'description'	=>	Str::random(20),
	        	'completed'		=>	false
	        ]);
    	}
    }
}
