@vite('resources/css/app.css')
<div class="min-h-screen bg-gradient-to-b from-sky-100 to-white flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <form method="POST" action="{{ route('login') }}" class="bg-white p-8 rounded-2xl shadow-lg">
            @csrf
            
            <!-- Icon -->
            <div class="mb-6 text-center">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-xs">
                    Eventify
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Se connecter avec vos données</h2>
                <p class="mt-2 text-sm text-gray-600">Pour réserver vos évenements avec toute sécurité. Tout ça gratuitement</p>
            </div>

            <div class="mb-4">
                <input id="email" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" 
                       type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                <error :messages="$errors->get('email')" class="text-sm text-red-500 mt-1" />
            </div>

            <div class="mb-4">
                <input id="password" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" 
                       type="password" name="password" placeholder="Password" required />
                <error :messages="$errors->get('password')" class="text-sm text-red-500 mt-1" />
            </div>

            <button type="submit" class="w-full py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                Se connecter
            </button>

            <div class="text-center mt-4 mb-2">
                <a class="text-sm text-gray-600 hover:text-gray-800" href="{{ route('register') }}">
                    Vous n'avez pas encore de compte? Créez-en un
                </a>
            </div>

        </form>
    </div>
</div>