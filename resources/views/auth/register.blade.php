<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <span>Cochez si admin</span>
            <input type="checkbox" name="is_admin" class="is_admin" onchange="cocherBtnAdmin(this)"/>
        </div>

        <div class="mt-4" id="input_secret" hidden>
            <x-input-label for="secret_key" :value="__('Code secret')" />
            <x-text-input id="secret_key" class="block mt-1 w-full"
                            type="password"
                            name="secret_key"
                            required 
                            oninput="validateSecretKey()" />
            <x-input-error :messages="$errors->get('')" class="mt-2" />
            <div id="error-message" class="text-red-500 mt-2" style="display: none;">
                Le code secret est incorrect.
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
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
            // Si le champ "secret_key" est caché, pas de validation
            errorMessage.style.display = 'none';
            return true; // Le champ secret_key n'est pas obligatoire
        }

        // Si le champ est visible et que la valeur est incorrecte
        if (secretKeyValue !== '9A0aI|3pDr#') {
            errorMessage.style.display = 'block';  // Affiche l'erreur
            return false; // Ne permet pas l'envoi du formulaire
        } else {
            errorMessage.style.display = 'none';  // Cache l'erreur si correct
            return true; // Permet l'envoi du formulaire
        }
    }

    // Empêcher la soumission du formulaire si secret_key est incorrect
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!validateSecretKey()) {
            e.preventDefault(); // Empêche l'envoi du formulaire si la validation échoue
        }
    });
</script>

