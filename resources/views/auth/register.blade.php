<x-guest-layout>
    <div class="mb-10 flex flex-col items-center">
        {{-- TWOJE LOGO --}}
        <div class="flex items-center gap-1 mb-2">
            <div class="bg-red-600 text-white font-black text-2xl px-4 py-2 rounded-2xl tracking-tighter">S</div>
            <span class="text-3xl font-black text-gray-900 tracking-tighter ml-0.5">klep.</span>
        </div>
        <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight">Dołącz do nas</h2>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">Imię i nazwisko</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                   class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                   class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">Hasło</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                   class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1.5 ml-1">Potwierdź hasło</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                   class="w-full bg-gray-50 border-none ring-1 ring-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-red-500 transition-all outline-none">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 mt-6">
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-black uppercase tracking-widest transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-red-900/20">
                Załóż konto →
            </button>

            <a class="text-center text-xs font-bold text-gray-500 hover:text-red-600 transition-colors" href="{{ route('login') }}">
                Masz już konto? Zaloguj się
            </a>
        </div>
    </form>
</x-guest-layout>
