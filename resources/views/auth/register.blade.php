@vite('resources/css/app.css')

<div class="min-h-screen bg-gradient-to-b from-sky-100 to-white flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <form method="POST" action="{{ route('register') }}" class="bg-white p-8 rounded-2xl shadow-lg">
            @csrf
            
            <!-- Icon & Title -->
            <div class="mb-6 text-center">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-gray-600" viewBox="0 0 24 24" fill="none">
                        <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Créer votre compte</h2>
                <p class="mt-2 text-sm text-gray-600">Nous joindre pour commencer</p>
            </div>

            <!-- Name -->
            <div class="mb-4">
                <input id="name" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" 
                    type="text" name="name" placeholder="Noms" :value="old('name')" required autofocus />
                <error :messages="$errors->get('name')" class="text-sm text-red-500 mt-1" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <input id="email" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" 
                    type="email" name="email" placeholder="Email" :value="old('email')" required />
                <error :messages="$errors->get('email')" class="text-sm text-red-500 mt-1" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <input id="password" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" 
                    type="password" name="password" placeholder="Mot de passe" required />
                <error :messages="$errors->get('password')" class="text-sm text-red-500 mt-1" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <input id="password_confirmation" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" 
                    type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required />
                <error :messages="$errors->get('password_confirmation')" class="text-sm text-red-500 mt-1" />
            </div>

            <!-- Admin Checkbox -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="is_admin" class="is_admin w-4 h-4 text-gray-600 border-gray-300 rounded" onchange="cocherBtnAdmin(this)"/>
                <span class="ml-2 text-sm text-gray-600">Administrateur?</span>
            </div>

            <!-- Secret Key -->
            <div class="mb-4" id="input_secret" hidden>
                <input id="secret_key" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200" 
                    type="password" name="secret_key" placeholder="Code secret" oninput="validateSecretKey()" />
                <div id="error-message" class="text-sm text-red-500 mt-1" style="display: none;">
                    Code secret invalide.
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full py-3 bg-gray-900 text-white rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                    Nous joindre
                </button>
            </div>

            <div class="mt-4 text-center">
                <a class="text-sm text-gray-600 hover:text-gray-800" href="{{ route('login') }}">
                    Avez-vous déjà un compte? Se connecter
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const cocherBtnAdmin = (val) => {
        const secretKeyField = document.getElementById("input_secret");
        if (val.checked) {
            secretKeyField.removeAttribute("hidden");
        } else {
            secretKeyField.setAttribute("hidden", "hidden");
        }
    }

    const validateSecretKey = () => {
        const secretKeyInput = document.getElementById('secret_key');
        const errorMessage = document.getElementById('error-message');
        const secretKeyValue = secretKeyInput.value;

        if (document.getElementById("input_secret").hasAttribute("hidden")) {
            errorMessage.style.display = 'none';
            return true;
        }

        if (secretKeyValue !== '9A0aI|3pDr#') {
            errorMessage.style.display = 'block';
            return false;
        } else {
            errorMessage.style.display = 'none';
            return true;
        }
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        if (!validateSecretKey()) {
            e.preventDefault();
        }
    });
</script>