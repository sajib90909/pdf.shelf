<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(200),
            'publisher' => $this->faker->name,
            'writer' => $this->faker->name,
            'upload_by' => rand(2,25),
            'category_id' => rand(1,10)
        ];
    }
}
