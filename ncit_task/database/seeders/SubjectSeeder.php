<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        // Create dummy subjects
        Subject::factory()->count(5)->create();

        $userIds = [2, 4, 5, 6];
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            foreach ($userIds as $userId) {

                $obtainedMark = rand(50, 100);

                if (User::where('id', $userId)->exists()) {
                    DB::table('subject_user')->insert([
                        'user_id' => $userId,
                        'subject_id' => $subject->id,
                        'obtained_mark' => $obtainedMark,
                    ]);
                }
            }
        }
    }
}
