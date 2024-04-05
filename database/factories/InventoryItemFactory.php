<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryItem>
 */
class InventoryItemFactory extends Factory
{
    /**
     * The sentence being used by the factory.
     */
    protected static ?string $paragraph;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->streetName(),
            'inventory_id' => mt_rand(1, 600),
//            'image' => 'https://picsum.photos/id/20/575/350',
            'quantity' => mt_rand(1, 50),
            'description' => static::$paragraph ??= fake()->paragraph(),
        ];
    }
}
