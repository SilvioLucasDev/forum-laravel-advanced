<?php

namespace Database\Factories;

use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReplySupport>
 */
class ReplySupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => 'Você deve fazer isso '.fake()->text(10),
            'user_id' => User::all()->random()->id,
            'support_id' => Support::all()->random()->id,
        ];
    }
}
