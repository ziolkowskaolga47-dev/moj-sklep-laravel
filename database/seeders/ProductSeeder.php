<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Figurka Geralt (Ronin)',
                'description' => 'Limitowana edycja figurki Geralta w stroju Ronina. Wysokość 30cm.',
                'price' => 736.77,
                'vat_rate' => 23,
                'stock' => 5,
            ],
            [
                'name' => 'V-Dolce 5000 + Bonus',
                'description' => 'Zestaw 5000 V-Dolców do wykorzystania w Fortnite na skiny i karnet.',
                'price' => 159.89,
                'vat_rate' => 23,
                'stock' => 50,
            ],
            [
                'name' => 'Elden Ring: DLC',
                'description' => 'Oficjalny klucz do dodatku Shadow of the Erdtree. Przygotuj się na wyzwanie.',
                'price' => 207.87,
                'vat_rate' => 23,
                'stock' => 100,
            ],
            [
                'name' => 'Słuchawki Gamingowe',
                'description' => 'Profesjonalne słuchawki z mikrofonem i podświetleniem RGB.',
                'price' => 149.99,
                'vat_rate' => 23,
                'stock' => 20,
            ],
            [
                'name' => 'Klawiatura Mechaniczna',
                'description' => 'Klawiatura mechaniczna z pełnym RGB i brązowymi przełącznikami.',
                'price' => 299.00,
                'vat_rate' => 23,
                'stock' => 15,
            ],
            [
                'name' => 'Myszka Bezprzewodowa',
                'description' => 'Myszka bezprzewodowa o wysokiej czułości, idealna dla graczy.',
                'price' => 89.50,
                'vat_rate' => 23,
                'stock' => 30,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}