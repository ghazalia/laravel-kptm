<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('trainings')->insert([
        //     'title' => 'Laravel Training 6 Days',
        //     'description' => 'The 6 days training session focus on enhancement API',

        // ]);
        Training::factory()
            ->times(100)
            ->create();
    }
}
