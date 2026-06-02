<?php

namespace Database\Factories;

use App\Models\books;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<books>
 */
class booksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title'            => $this->faker->sentence(3),
        'author'           => $this->faker->name(),
        'description'      => $this->faker->paragraph(4),
        'genre'            => $this->faker->randomElement(['Fiction', 'Non-Fiction', 'Mystery', 'Science Fiction', 'Fantasy', 'Biography', 'History', 'Romance']),
        'publication_year' => $this->faker->numberBetween(2000, date('Y')),
    ];
}
}
