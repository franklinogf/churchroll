<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TagType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
final class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word();

        return [
            'name' => ['en' => fake('en')->word(), 'es' => fake('es')->word()],
            'slug' => Str::slug($name),
            'type' => fake()->optional()->randomElement(TagType::values()),
            'order_column' => 0,
            'is_regular' => false,
        ];
    }

    public function category(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => TagType::CATEGORY->value,
        ]);
    }

    public function skill(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => TagType::SKILL->value,
        ]);
    }

    public function regular(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_regular' => true,
        ]);
    }
}
