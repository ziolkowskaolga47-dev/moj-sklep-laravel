<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // 1. Pobieramy wszystkie kategorie do menu
        $categories = Category::all();

        // 2. Budujemy zapytanie
        $query = Product::query();

        // 3. WYSZUKIWARKA
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // 4. FILTR KATEGORII
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 5. SORTOWANIE
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        // 6. Pobranie wyników
        $products = $query->get();

        // 7. Przekazanie do widoku
        return view('welcome', compact('products', 'categories'));
    }

    // --- DODANA FUNKCJA SHOW ---
    public function show(Product $product)
    {
        // Pobieramy kategorie, żeby nawigacja w show.blade.php nie wywaliła błędu
        $categories = Category::all();
        
        return view('products.show', compact('product', 'categories'));
    }
}