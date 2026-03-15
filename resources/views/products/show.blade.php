<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - MOJ.SKLEP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    {{-- SEKCJA POWIADOMIEŃ --}}
    @if(session('success'))
        <div id="success-alert" class="fixed top-24 left-1/2 -translate-x-1/2 z-[100] w-full max-w-xl px-6 transition-all duration-500">
            <div class="bg-green-600 text-white px-6 py-4 rounded-3xl shadow-2xl flex items-center justify-between animate-bounce">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="hover:opacity-70 transition-opacity">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if(alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    {{-- NOWY NAVBAR --}}
    <nav class="bg-white border-b border-gray-100 h-20 flex items-center px-6 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto w-full flex items-center">
            <a href="/" class="group flex items-center active:scale-95 transition-transform">
                <span class="text-2xl font-black text-gray-900 tracking-tighter uppercase">
                    MOJ<span class="text-red-600">.</span>SKLEP
                </span>
            </a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-6 py-12">
        <a href="/" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-red-600 mb-8 transition-colors uppercase tracking-widest">
            ← Wróć do sklepu
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 bg-white p-8 rounded-[40px] shadow-sm border border-gray-100">
            <div class="rounded-3xl overflow-hidden bg-gray-50 aspect-square border border-gray-100">
                @php
                    $imgName = $product->image;
                    if (!$imgName) { 
                        $displayImg = 'geralt.jpg'; 
                    } else {
                        $displayImg = str_ends_with($imgName, '.jpg') ? $imgName : $imgName . '.jpg';
                    }
                @endphp
                <img src="/images/{{ $displayImg }}" class="w-full h-full object-cover">
            </div>

            <div class="flex flex-col justify-center">
                <span class="text-red-600 font-bold uppercase tracking-[0.3em] text-[10px] mb-4">{{ $product->category->name ?? 'Nowość' }}</span>
                <h1 class="text-4xl font-black mb-6 text-gray-900 tracking-tight">{{ $product->name }}</h1>
                <p class="text-gray-500 text-lg leading-relaxed mb-10">{{ $product->description }}</p>

                <div class="bg-gray-50 p-8 rounded-3xl mb-10 border border-gray-100">
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-2">Cena produktu</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-5xl font-black text-red-600">
    {{ number_format($product->price, 2, ',', ' ') }}
</span>
                        <span class="text-xl font-bold text-red-600">PLN</span>
                    </div>
                </div>

                {{-- FORMULARZ Z WYBOREM ILOŚCI --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Ilość:</span>
                        <div class="flex items-center bg-gray-100 rounded-2xl p-1 border border-gray-200">
                            <button type="button" onclick="decrementQty()" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow-sm text-gray-600 hover:text-red-600 transition-colors font-black">-</button>
                            
                            <input type="number" name="quantity" id="quantity" value="1" min="1" 
                                   class="w-12 bg-transparent text-center font-black text-gray-900 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                            
                            <button type="button" onclick="incrementQty()" class="w-10 h-10 flex items-center justify-center bg-white rounded-xl shadow-sm text-gray-600 hover:text-red-600 transition-colors font-black">+</button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-6 rounded-3xl font-black text-lg shadow-2xl shadow-red-100 transition-all hover:scale-[1.02] active:scale-95 uppercase">
                        DODAJ DO KOSZYKA
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function incrementQty() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
        }
        function decrementQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
</body>
</html>