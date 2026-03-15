<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str; // To jest kluczowe!

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Figurka Geralt (Ronin)',
                'slug' => Str::slug('Figurka Geralt (Ronin)'),
                'description' => 'Limitowana edycja figurki Geralta w stroju Ronina. Wysokość 30cm.',
                'price' => 736.77,
                'vat_rate' => 23,
                'stock' => 5,
                'sku' => 'GER-RON-001',
            ],
            [
                'name' => 'V-Dolce 5000 + Bonus',
                'slug' => Str::slug('V-Dolce 5000 Bonus'),
                'description' => 'Zestaw 5000 V-Dolców do wykorzystania w Fortnite na skiny i karnet.',
                'price' => 159.89,
                'vat_rate' => 23,
                'stock' => 50,
                'sku' => 'FORT-VD-5000',
            ],
            [
                'name' => 'Elden Ring: DLC',
                'slug' => Str::slug('Elden Ring DLC'),
                'description' => 'Oficjalny klucz do dodatku Shadow of the Erdtree.',
                'price' => 207.87,
                'vat_rate' => 23,
                'stock' => 100,
                'sku' => 'ER-DLC-SHADOW',
            ],
            [
                'name' => 'Słuchawki Gamingowe',
                'slug' => Str::slug('Sluchawki Gamingowe'),
                'description' => 'Profesjonalne słuchawki z mikrofonem i podświetleniem RGB.',
                'price' => 149.99,
                'vat_rate' => 23,
                'stock' => 20,
                'sku' => 'HW-EAR-G300',
            ],
            [
                'name' => 'Klawiatura Mechaniczna',
                'slug' => Str::slug('Klawiatura Mechaniczna'),
                'description' => 'Klawiatura mechaniczna z pełnym RGB i brązowymi przełącznikami.',
                'price' => 299.00,
                'vat_rate' => 23,
                'stock' => 15,
                'sku' => 'HW-KBD-MECH',
            ],
            [
                'name' => 'Myszka Bezprzewodowa',
                'slug' => Str::slug('Myszka Bezprzewodowa'),
                'description' => 'Myszka bezprzewodowa o wysokiej czułości, idealna dla graczy.',
                'price' => 89.50,
                'vat_rate' => 23,
                'stock' => 30,
                'sku' => 'HW-MSE-WIRE',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}