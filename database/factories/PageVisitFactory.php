<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\PageVisit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageVisit>
 */
class PageVisitFactory extends Factory
{

    protected $model = PageVisit::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'visited_at' => now()->subDays(rand(0, 30))->subMinutes(rand(1, 55)),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
