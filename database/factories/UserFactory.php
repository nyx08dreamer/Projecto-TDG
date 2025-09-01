<?php

namespace Database\Factories;

use App\Models\Entities\Admin\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entities\Admin\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
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
        //     first_name
        //     last_name
        //     document_number
        //     email
        //     username
        //     password
        //     email_verified_at
        //     start_date
        //     end_date
        //     rememberToken
        //     created_by
        //     updated_by

            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'document_number' => fake()->randomNumber(8),
            'email' => fake()->unique()->safeEmail(),

            'username' => fake()->word(),
            'password' => '$2a$12$W2NjJAwQkEmCznI2KirAY.JXvuVxCUmibHFpn/sCcCQjsTuUznqXq',

            'start_date' => ($start = fake()->dateTimeBetween('-1 year','now')) ,
            'email_verified_at' => fake()->randomElement([null, ($validated = fake()->dateTimeBetween($start,'now'))]),
            'end_date' => fake()->randomElement([null,fake()->dateTimeBetween($validated,'now')]),

            'remember_token' => Str::random(10),

            'created_by' => 1,
            'updated_by' => 1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
