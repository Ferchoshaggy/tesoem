<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
            <label style="width: 100%; color: white; font-size: 250%; text-align: center;">Registrarse</label>
        </x-slot>

            <div class="container-fluid fixed-top p-4">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a href="" class="text-muted">Entrar</a>
                        @else
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <x-jet-input type="text" name="matricula" :value="old('matricula')" placeholder="Matricula" required style="font-weight: bold; font-size: 20px;"/>
                </div>

                <div class="mb-3">
                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" style="font-weight: bold; font-size: 20px;" placeholder="Nombre"/>
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="mb-3">

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" placeholder="Correo" required style="font-weight: bold; font-size: 20px;" />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-input type="file" name="foto" required style="font-weight: bold; font-size: 20px;"/>
                </div>

                <div class="mb-3">

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" placeholder="Contraseña" required style="font-weight: bold; font-size: 20px;" autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">

                    <x-jet-input class="form-control" type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required style="font-weight: bold; font-size: 20px;" autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-md-6" style="text-align: center;">
                            
                            @if (Route::has('password.request'))
                                <a class="text-muted me-3" href="{{ route('login') }}" style="text-decoration: none; font-size: 20px;">
                                    ¿Ya tienes cuenta?
                                </a>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success" style="color: white; font-size: 25px; padding-left: 20px; padding-right: 20px; width: 100%;">
                                Registrar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>