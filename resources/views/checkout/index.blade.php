<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienie - MOJ.SKLEP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    {{-- GÓRNA NAWIGACJA --}}
    <nav class="bg-white border-b border-gray-100 h-20 flex items-center px-6 sticky top-0 z-50 mb-10">
        <div class="max-w-6xl mx-auto w-full flex items-center justify-between">
            <a href="/" class="group flex items-center active:scale-95 transition-transform">
                <span class="text-2xl font-black text-gray-900 tracking-tighter uppercase">
                    MOJ<span class="text-red-600">.</span>SKLEP
                </span>
            </a>
            <div class="hidden md:block text-[10px] font-black uppercase tracking-widest text-gray-400">
                Bezpieczne zamówienie • SSL Encrypted
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 pb-20">
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                {{-- LEWA KOLUMNA: DANE I DOSTAWA --}}
                <div class="lg:col-span-2 space-y-8">
                    <h1 class="text-4xl font-black text-gray-900 mb-8 tracking-tight">Finalizacja zamówienia</h1>

                    {{-- DANE --}}
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                        <h2 class="text-xl font-black text-gray-900 mb-8 flex items-center gap-3">
                            <span class="w-2 h-8 bg-red-600 rounded-full"></span>
                            Dane odbiorcy
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-1">E-mail *</label>
                                <input type="email" name="email" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-1">Imię *</label>
                                <input type="text" name="first_name" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-1">Nazwisko *</label>
                                <input type="text" name="last_name" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-1">Ulica i numer *</label>
                                <input type="text" name="address" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-1">Kod pocztowy *</label>
                                <input type="text" name="zip_code" required placeholder="00-000" class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 mb-2 ml-1">Miasto *</label>
                                <input type="text" name="city" required class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
                            </div>
                        </div>
                    </div>

                    {{-- DOSTAWA --}}
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                        <h2 class="text-xl font-black text-gray-900 mb-8 flex items-center gap-3">
                            <span class="w-2 h-8 bg-red-600 rounded-full"></span>
                            Metoda dostawy
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center justify-between p-5 rounded-3xl bg-gray-50 border-2 border-transparent has-[:checked]:border-red-600 has-[:checked]:bg-red-50 cursor-pointer transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="delivery" value="courier" checked class="w-5 h-5 text-red-600 focus:ring-red-500">
                                    <span class="font-bold text-gray-800">Kurier DPD</span>
                                </div>
                                <span class="font-black text-gray-900 text-sm uppercase">Gratis</span>
                            </label>

                            <label class="flex items-center justify-between p-5 rounded-3xl bg-gray-50 border-2 border-transparent has-[:checked]:border-red-600 has-[:checked]:bg-red-50 cursor-pointer transition-all">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="delivery" value="paczkomat" class="w-5 h-5 text-red-600 focus:ring-red-500">
                                    <span class="font-bold text-gray-800">Paczkomat</span>
                                </div>
                                <span class="font-black text-gray-900 text-sm uppercase">Gratis</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- PRAWA KOLUMNA: PŁATNOŚĆ I SUMA --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-32 space-y-6">
                        <div class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-gray-200/50 border border-gray-100">
                            <h2 class="text-xl font-black text-gray-900 mb-8">Płatność</h2>
                            
                            <div class="space-y-3 mb-10">
                                @foreach(['Karta (Stripe)', 'Przelewy24', 'Przelew'] as $method)
                                <label class="flex items-center gap-4 p-4 rounded-2xl hover:bg-gray-50 cursor-pointer transition-all border border-gray-50 has-[:checked]:border-red-100 has-[:checked]:bg-red-50/30">
                                    <input type="radio" name="payment" value="{{ strtolower($method) }}" class="w-5 h-5 text-red-600" {{ $loop->first ? 'checked' : '' }}>
                                    <span class="text-sm font-bold text-gray-700">{{ $method }}</span>
                                </label>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-8">
                                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Łącznie do zapłaty</p>
                                <div class="flex items-baseline gap-2 mb-1">
                                    <span class="text-5xl font-black text-gray-900">736,77</span>
                                    <span class="text-xl font-bold text-gray-400 uppercase">PLN</span>
                                </div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                                    W tym 23% VAT: 169,46 PLN
                                </p>
                            </div>

                            <div class="mt-10 space-y-4">
                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <input type="checkbox" required class="mt-1 w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                    <span class="text-[11px] text-gray-500 leading-tight">Akceptuję <span class="text-red-600 font-bold hover:underline cursor-pointer">regulamin</span> oraz politykę prywatności sklepu.</span>
                                </label>

                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-6 rounded-3xl font-black uppercase tracking-widest transition-all hover:scale-[1.03] active:scale-95 shadow-2xl shadow-red-200">
                                    Zatwierdzam i płacę
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>
</html>