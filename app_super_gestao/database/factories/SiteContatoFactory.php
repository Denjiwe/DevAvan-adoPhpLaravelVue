<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use App\Models\SiteContato;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteContato>
 */
class SiteContatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\SiteContato::class;

    public function definition()
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->unique()->email(),
            'motivo_contato' => fake()->numberBetween(1,3),
            'telefone' => fake()->tollFreePhoneNumber(),
            'mensagem' => fake()->text(200)
        ];
    }
}