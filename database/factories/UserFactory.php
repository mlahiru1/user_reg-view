<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            // Password encrypted, default 'password'
            'password' => bcrypt('password'),

            // full_name matches string max 255
            'full_name' => $this->faker->full_name(),

            // dob: date before today - 5 years
            'dob' => $this->faker->dateTimeBetween('-80 years', '-5 years')->format('Y-m-d'),

            // image: store image filename as a string placeholder
            // Note: Factory can't generate actual image files,
            // so just generate a fake filename here
            'image' => $this->faker->randomElement([
                'avatar1.jpg',
                'avatar2.png',
                'avatar3.jpeg'
            ]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
