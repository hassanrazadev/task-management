<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory {
    protected $model = Task::class;

    public function definition(): array {
        return [
            'name' => $this->faker->text(20),
            'priority' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'project_id' => Project::inRandomOrder()->first()->id,
        ];
    }
}
