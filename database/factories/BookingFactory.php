<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "id_user" => $this->faker->paragraph,
            "id_tour" => $this->faker->paragraph,
            "name" => $this->faker->paragraph,
            "email" => $this->faker->paragraph,
            "phone" => $this->faker->paragraph,
            "address" => $this->faker->paragraph,
            "adult" => $this->faker->paragraph,
            "children" => $this->faker->paragraph,
            "young" => $this->faker->paragraph,
            "baby" => $this->faker->paragraph,
            "note" => $this->faker->paragraph,
            "pay" => $this->faker->paragraph,
            "price" => $this->faker->paragraph,
        ];
    }
}
