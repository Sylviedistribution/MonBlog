<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        $random = rand(1, 4);
        $titre = fake()->sentence();
        return [
            'titre' => $titre,
            'slug' => Str::slug($titre),
            'contenu' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry .
                          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                          when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                          It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                          essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
                          Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                          versions of Lorem Ipsum.",
            'categorie' => fake()->word(),
            'imagePath' => 'imagePost/image1.jpg',
            'user_id' => $random

        ];
    }
}
