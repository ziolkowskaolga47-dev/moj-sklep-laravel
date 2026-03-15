<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienie - Sklep</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

@php
    // 1. Obliczamy sumę produktów
    $subtotal = 0;
    if(session('cart')) {
        foreach(session('cart') as $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }
    }

    // 2. Definiujemy czy dostawa jest darmowa (próg 350 zł)
    $isFreeShipping = ($subtotal >= 350);

    // 3. Ustalany koszt dostawy na podstawie progu
    $shippingCost = $isFreeShipping ? 0 : 18.45;
    $total = $subtotal + $shippingCost;
@endphp

    <div class="max-w-4xl mx-auto p-6 md:p-12">
        
        {{-- NAGŁÓWEK --}}
        <div class="mb-10 flex items-center justify-between">

<div class="mb-10 flex items-center justify-between">
    <a href="/" class="group flex items-center active:scale-95 transition-transform">
        <span class="text-2xl font-black text-gray-900 tracking-tighter uppercase">
            MOJ<span class="text-red-600">.</span>SKLEP
        </span>
    </a>
    <h1 class="text-xl font-black text-gray-400 uppercase tracking-widest border-l border-gray-200 pl-6 hidden md:block">
        Zamówienie
    </h1>
</div>

        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
            @csrf

            {{-- SEKCJA 1: DANE --}}
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                <h2 class="text-lg font-black text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-red-600 rounded-full"></span>
                    Dane kontaktowe i dostawy
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-1">
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">E-mail *</label>
                        <input type="email" name="email" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">Imię *</label>
                        <input type="text" name="first_name" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">Nazwisko *</label>
                        <input type="text" name="last_name" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">Ulica i numer *</label>
                        <input type="text" name="address" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">Miasto *</label>
                        <input type="text" name="city" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">Kod pocztowy *</label>
                        <input type="text" name="zip_code" required placeholder="00-000" class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                    </div>
                </div>
            </div>

{{-- SEKCJA 2: DOSTAWA --}}
<div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
    <h2 class="text-lg font-black text-gray-900 mb-6 flex items-center gap-2">
        <span class="w-2 h-6 bg-red-600 rounded-full"></span>
        Sposób dostawy
    </h2>
    <div class="space-y-3">
        {{-- KURIER --}}
        <label class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 border-2 border-transparent has-[:checked]:border-red-600 has-[:checked]:bg-red-50 cursor-pointer transition-all">
            <div class="flex items-center gap-3">
                <input type="radio" name="delivery" value="courier" checked class="w-4 h-4 text-red-600 focus:ring-red-500">
                <span class="font-bold text-gray-800">Kurier</span>
            </div>
<span class="font-black text-gray-900">
    {{ $subtotal >= 350 ? 'GRATIS' : '18,45 zł' }}
</span>
        </label>
        
        {{-- PACZKOMAT --}}
        <label class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 border-2 border-transparent has-[:checked]:border-red-600 has-[:checked]:bg-red-50 cursor-pointer transition-all">
            <div class="flex items-center gap-3">
                <input type="radio" name="delivery" value="paczkomat" class="w-4 h-4 text-red-600 focus:ring-red-500">
                <span class="font-bold text-gray-800">Paczkomat InPost</span>
            </div>
<span class="font-black text-gray-900">
    {{ $subtotal >= 350 ? 'GRATIS' : '12,30 zł' }}
</span>
        </label>
    </div>
</div>

            {{-- SEKCJA 3: PŁATNOŚĆ I PODSUMOWANIE --}}
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div>
                        <h2 class="text-lg font-black text-gray-900 mb-6 flex items-center gap-2">
                            <span class="w-2 h-6 bg-red-600 rounded-full"></span>
                            Sposób płatności
                        </h2>
                        <div class="space-y-3">
                            @foreach(['Karta (Stripe)', 'Przelewy24', 'Przelew tradycyjny'] as $method)
                            <label class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 cursor-pointer transition-colors border border-transparent hover:border-gray-100">
                                <input type="radio" name="payment" value="{{ strtolower($method) }}" class="w-4 h-4 text-red-600 accent-red-600" {{ $loop->first ? 'checked' : '' }}>
                                <span class="text-sm font-bold text-gray-700">{{ $method }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-col justify-between">
                        <div>
                            <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Do zapłaty</p>
                            <p class="text-4xl font-black text-gray-900 mb-1">
                                {{ number_format($total, 2, ',', ' ') }} <span class="text-xl text-gray-400">zł brutto</span>
                            </p>
                            <p class="text-[10px] text-gray-400 font-bold italic uppercase">
                                W tym 23% VAT: {{ number_format($total * 0.23, 2, ',', ' ') }} zł
                            </p>
                        </div>

<div class="space-y-3 mb-6">
    {{-- CHECKBOX REGULAMIN --}}
    <label class="flex items-start gap-3 cursor-pointer group">
        <input type="checkbox" name="terms" required class="mt-1 w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
        <span class="text-xs text-gray-500 leading-tight">
            Akceptuję <a href="{{ url('/regulamin') }}" target="_blank" class="text-red-600 font-bold underline hover:text-red-700">regulamin</a> sklepu *
        </span>
    </label>

    {{-- CHECKBOX POLITYKA --}}
    <label class="flex items-start gap-3 cursor-pointer group">
        <input type="checkbox" name="privacy" required class="mt-1 w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
        <span class="text-xs text-gray-500 leading-tight">
            Akceptuję <a href="{{ url('/polityka-prywatnosci') }}" target="_blank" class="text-red-600 font-bold underline hover:text-red-700">politykę prywatności</a> *
        </span>
    </label>
</div>

                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-black uppercase tracking-widest transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-red-900/20">
                                Złóż zamówienie
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>