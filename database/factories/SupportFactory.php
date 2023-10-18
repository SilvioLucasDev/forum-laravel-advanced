<?php

namespace Database\Factories;

use App\Enums\SupportStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => 'Por que o '.fake()->text(10).'?',
            'status' => fake()->randomElement(SupportStatusEnum::cases()),
            'body' => 'Descrição da dúvida '.fake()->text(30),
        ];
    }
}
