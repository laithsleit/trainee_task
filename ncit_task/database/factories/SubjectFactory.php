<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'pass_mark' => $this->faker->numberBetween(50, 70), // Assuming pass marks are between 50 and 70
        ];
    }
}
