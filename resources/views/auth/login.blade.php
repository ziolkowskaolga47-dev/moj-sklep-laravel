<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-10 flex flex-col items-center">
        {{-- TWOJE LOGO --}}
        <div class="flex items-center gap-1 mb-2">
            <div class="bg-red-600 text-white font-black text-2xl px-4 py-2 rounded-2xl tracking-tighter shadow-lg shadow-red-900/20">S</div>
            <span class="text-3xl font-black text-gray-900 tracking-tighter ml-0.5">klep.</span>
        </div>
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight">Witaj ponownie</h2>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1 italic">Twój E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                   class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none text-gray-900">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-1.5 ml-1">
                <label class="block text-[10px] font-black uppercase text-gray-400 italic">Hasło</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-bold text-red-600 hover:text-red-700 transition-colors uppercase tracking-widest underline" href="{{ route('password.request') }}">
                        Zapomniałeś?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                   class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none text-gray-900">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center ml-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-500 bg-gray-50 transition-all cursor-pointer">
                <span class="ms-2 text-[11px] font-black uppercase text-gray-400 group-hover:text-gray-900 transition-colors tracking-tighter">Zapamiętaj mnie</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-black uppercase tracking-widest transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-red-900/20">
                Zaloguj się →
            </button>

            <a class="text-center text-[10px] font-black uppercase text-gray-400 hover:text-red-600 transition-colors tracking-widest" href="{{ route('register') }}">
                Nie masz konta? <span class="underline text-red-600">Załóż je tutaj</span>
            </button>
        </div>
    </form>
</x-guest-layout>