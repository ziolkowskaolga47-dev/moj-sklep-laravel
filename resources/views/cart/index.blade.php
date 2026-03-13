@php
    $total = 0;
    if(session('cart')) {
        foreach(session('cart') as $details) {
            $total += $details['price'] * $details['quantity'];
        }
    }
@endphp

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twój Koszyk - Sklep</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white border-b border-gray-100 h-20 flex items-center px-6 sticky top-0 z-50">
        <a href="/" class="flex items-center gap-2 font-black text-xl tracking-tighter">
            <div class="bg-red-600 text-white px-3 py-1 rounded-xl">S</div> klep
        </a>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-black mb-10 text-gray-900 tracking-tight">Twój Koszyk</h1>

        @if(session('cart') && count(session('cart')) > 0)
            {{-- BANER DARMOWEJ DOSTAWY --}}
            @if($total < 350)
                <div class="bg-blue-50 p-4 rounded-2xl mb-8 border border-blue-100">
                    <p class="text-blue-700 text-xs font-bold text-center">
                        Dodaj produkty za jeszcze <span class="text-blue-900 font-black">{{ number_format(350 - $total, 2) }} PLN</span>, aby otrzymać darmową dostawę! 🚚
                    </p>
                </div>
            @else
                <div class="bg-green-50 p-4 rounded-2xl mb-8 border border-green-100">
                    <p class="text-green-700 text-xs font-bold text-center">
                        Gratulacje! Twoja dostawa jest darmowa! 🎉
                    </p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                {{-- LISTA PRODUKTÓW --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach(session('cart') as $id => $details)
                        <div class="bg-white p-6 rounded-[30px] shadow-sm border border-gray-100 flex items-center gap-6 group hover:shadow-md transition-shadow">
                            <div class="w-24 h-24 rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 flex-shrink-0">
                               {{-- Poprawiona linia ze zdjęciem --}}
<img src="{{ asset('images/' . (str_contains($details['image'], '.') ? $details['image'] : $details['image'] . '.jpg')) }}" 
     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>

                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 text-lg">{{ $details['name'] }}</h3>
                                <p class="text-red-600 font-black">{{ number_format($details['price'], 2) }} PLN</p>
                            </div>

                            <div class="flex items-center gap-4">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center bg-gray-50 rounded-2xl p-1 border border-gray-100">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" 
                                           class="w-12 bg-transparent text-center font-bold text-gray-900 focus:outline-none">
                                    <button type="submit" class="bg-white text-gray-400 hover:text-red-600 p-2 rounded-xl transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>

                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-gray-50 text-gray-400 hover:text-red-600 hover:bg-red-50 p-3 rounded-2xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- PODSUMOWANIE --}}
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 sticky top-32">
                        <h2 class="text-2xl font-black mb-6 text-gray-900">Podsumowanie</h2>
                        
                        @php 
                            $shipping = ($total < 350) ? 18.45 : 0;
                            $grandTotal = $total + $shipping;
                        @endphp

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-gray-500 font-medium">
                                <span>Wartość produktów</span>
                                <span>{{ number_format($total, 2) }} PLN</span>
                            </div>
                            <div class="flex justify-between text-gray-500 font-medium">
                                <span>Dostawa</span>
                                @if($shipping == 0)
                                    <span class="text-green-600 font-bold">Gratis</span>
                                @else
                                    <span>{{ number_format($shipping, 2) }} PLN</span>
                                @endif
                            </div>
                            <div class="border-t border-gray-100 pt-4 flex justify-between">
                                <span class="text-lg font-bold">Razem</span>
                                <span class="text-2xl font-black text-red-600">{{ number_format($grandTotal, 2) }} PLN</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full bg-red-600 hover:bg-red-700 text-white text-center py-5 rounded-3xl font-black text-lg shadow-2xl shadow-red-100 transition-all hover:scale-[1.02] active:scale-95">
                            PRZEJDŹ DO KASY
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white p-20 rounded-[40px] text-center border border-gray-100 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Twój koszyk jest pusty</h2>
                <a href="/" class="inline-block bg-red-600 text-white px-10 py-4 rounded-2xl font-black mt-6">WRÓĆ NA ZAKUPY</a>
            </div>
        @endif
    </div>
</body>
</html>