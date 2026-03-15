<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mój Sklep</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    {{-- SEKCJA POWIADOMIEŃ --}}
    @if(session('success'))
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-[100] w-full max-w-xl px-6">
            <div class="bg-green-600 text-white px-6 py-4 rounded-3xl shadow-2xl flex items-center justify-between animate-bounce">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="hover:opacity-70 transition-opacity">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    @endif

    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-12">
                {{-- NOWE LOGO --}}
                <a href="/" class="group flex items-center active:scale-95 transition-transform">
                    <span class="text-3xl font-[1000] text-gray-900 tracking-tighter uppercase italic">
                        Store<span class="text-red-600">.</span>pl
                    </span>
                </a>
                
                <div class="hidden md:flex items-center gap-6">
                    <a href="/" class="text-xs font-black uppercase tracking-widest {{ !request('category') ? 'text-red-600' : 'text-gray-400 hover:text-gray-900' }}">Wszystko</a>
                    @foreach($categories as $category)
                        <a href="/?category={{ $category->slug }}&sort={{ request('sort') }}&search={{ request('search') }}" 
                           class="text-xs font-black uppercase tracking-widest {{ request('category') == $category->slug ? 'text-red-600' : 'text-gray-400 hover:text-gray-900' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-6">
                @auth
                    <div class="flex items-center gap-4 border-r border-gray-100 pr-6">
                        <div class="flex flex-col items-end">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Konto</span>
                            <span class="text-sm font-black text-gray-900">{{ Auth::user()->name }}</span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <a href="{{ route('profile.edit') }}" class="text-[10px] font-bold bg-gray-100 text-gray-600 px-3 py-2 rounded-xl hover:bg-gray-200 transition-colors uppercase">
                                Profil
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-[10px] font-bold bg-red-50 text-red-600 px-3 py-2 rounded-xl hover:bg-red-100 transition-colors uppercase">
                                    Wyloguj
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">Zaloguj</a>
                    <a href="{{ route('register') }}" class="bg-red-600 text-white px-5 py-2.5 rounded-2xl text-sm font-bold hover:bg-red-700 shadow-lg shadow-red-100 transition-all hover:scale-105">Dołącz</a>
                @endauth

                <a href="{{ route('cart.index') }}" class="bg-gray-100 hover:bg-gray-200 p-3 rounded-2xl transition-colors relative">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-lg border-2 border-white">
                        {{ session('cart') ? count(session('cart')) : 0 }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto p-6 md:p-12">
        <header class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-[1000] text-gray-900 tracking-tighter uppercase italic">
                    @if(request('category'))
                        {{ $categories->firstWhere('slug', request('category'))->name ?? 'Kolekcja' }}
                    @else
                        Katalog
                    @endif
                </h1>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-[0.2em] mt-2">Dostępność: {{ $products->count() }} sztuk</p>
            </div>

            <form action="/" method="GET" class="flex-1 max-w-md relative group">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Szukaj w sklepie..." 
                       class="w-full bg-white border border-gray-100 py-4 pl-12 pr-4 rounded-2xl outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm group-hover:shadow-md">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>

            <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-50">
                <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Filtr:</span>
                <select onchange="window.location.href=this.value" class="text-xs font-black text-gray-900 uppercase cursor-pointer focus:outline-none bg-transparent">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Nowości</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Cena: rosnąco</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Cena: malejąco</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nazwa: A-Z</option>
                </select>
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($products as $product)
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-50 overflow-hidden hover:shadow-2xl transition-all duration-500 group">
                    <a href="{{ route('products.show', $product->id) }}" class="block aspect-[4/5] bg-gray-50 overflow-hidden relative">
                        <img src="{{ asset('images/' . ($product->image ?? 'geralt.jpg')) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                             onerror="this.onerror=null;this.src='{{ asset('images/geralt.jpg') }}'">
                        
                        {{-- NOWOCZESNA PLAKIETKA --}}
                        <div class="absolute top-6 left-6">
                            <span class="bg-white/90 backdrop-blur text-gray-900 text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest shadow-xl border border-white">
                                Nowości
                            </span>
                        </div>
                    </a>

                    <div class="p-8">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-red-600 text-[10px] font-black uppercase tracking-[0.2em]">{{ $product->category->name ?? 'Ogólna' }}</span>
                            <span class="flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">In Stock</span>
                            </span>
                        </div>

                        <h2 class="text-2xl font-black text-gray-900 mb-4 tracking-tight">{{ $product->name }}</h2>
                        
                        <div class="flex items-end justify-between pt-4 border-t border-gray-50">
                            <div>
                                <p class="text-gray-400 text-[9px] uppercase font-black tracking-widest mb-1">Cena końcowa</p>
                                <p class="text-3xl font-[1000] text-gray-900 tracking-tighter">
                                    {{ number_format($product->price_brutto ?? $product->price, 2) }}<span class="text-sm ml-1 text-red-600">PLN</span>
                                </p>
                            </div>
                            
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-900 hover:bg-red-600 text-white w-14 h-14 rounded-2xl flex items-center justify-center shadow-xl transition-all hover:scale-110 active:scale-95 group/btn">
                                    <svg class="w-6 h-6 group-hover/btn:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-40 text-center">
                    <span class="text-6xl mb-4 block">📦</span>
                    <p class="text-gray-400 text-sm font-black uppercase tracking-[0.3em]">Magazyn jest pusty</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>