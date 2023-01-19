<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
            <label style="width: 100%; color: white; font-size: 250%; text-align: center;">Iniciar Sesión</label>
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

        <div class="card-body">

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="text"
                                 name="matricula" :value="old('matricula')" placeholder="Matricula" required style="font-weight: bold; font-size: 20px;"/>
                    <x-jet-input-error for="matricula"></x-jet-input-error>
                </div>

                <div class="mb-3">

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" placeholder="Contraseña" required style="font-weight: bold; font-size: 20px; margin-top: 30px;" autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>


                <div class="mb-0">
                    <div class="row" style="margin-top: 30px; ">
                        <div class="col-md-6" style="text-align: center; margin-bottom: 30px;">
                            
                            @if (Route::has('password.request'))
                                <a class="text-muted me-3" href="{{ route('register') }}" style="text-decoration: none; font-size: 20px;">
                                    ¿no tienes cuenta?
                                </a>
                            @endif

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success bt" style="color: white; font-size: 25px; padding-left: 20px; padding-right: 20px; width: 100%;">
                                Entrar
                            </button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>