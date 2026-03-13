<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

public function add(Request $request, $id)
{
    // 1. Znajdź konkretny produkt po ID z URL
    $product = \App\Models\Product::findOrFail($id);
    
    // 2. Pobierz koszyk z sesji
    $cart = session()->get('cart', []);

    // 3. Pobierz ilość z formularza (przysłane przez name="quantity")
    // Jeśli z jakiegoś powodu jej nie ma, dajemy 1
    $quantity = (int) $request->input('quantity', 1);

    // 4. Jeśli produkt już jest w koszyku, zwiększ jego ilość o wybraną liczbę
    if(isset($cart[$id])) {
        $cart[$id]['quantity'] += $quantity;
    } else {
        // Jeśli go nie ma, dodaj nowy wpis
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    // 5. Zapisz z powrotem w sesji
    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Dodano ' . $quantity . ' szt. produktu ' . $product->name . ' do koszyka!');
}

    // Ta funkcja obsłuży Twoje przyciski + / - i usuwanie (ilość 0)
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            if($request->quantity > 0) {
                $cart[$id]['quantity'] = $request->quantity;
                $msg = "Zaktualizowano ilość!";
            } else {
                unset($cart[$id]);
                $msg = "Usunięto produkt z koszyka!";
            }
            session()->put('cart', $cart);
return redirect()->back()->with('success', 'Koszyk został zaktualizowany!');
        }
    }
    public function remove($id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Produkt został usunięty z koszyka!');
}
}