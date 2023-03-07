<style type="text/css">
    /*este es para el diseño del archivo */
    .arch{
      display: none;
    }

    .boton_file{
      display: inline-block;
      cursor: pointer;
      border-radius: 5px;
    }
    .row {
    --bs-gutter-x: 0 !important;
    }
</style>

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
            <label style="width: 100%; color: white; font-size: 250%; text-align: center;">Registrarse</label>
        </x-slot>

            <div class="container-fluid fixed-top p-4">
        <div class="col-12">
            <div class="d-flex justify-content-end">
                
            </div>
        </div>
    </div>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <x-jet-input type="text" name="matricula" :value="old('matricula')" placeholder="Matricula" required style="font-weight: bold; font-size: 20px;"/>
                </div>
                <div class="mb-3" style="background-color: #707070; color: #fff; padding: 10px; border-radius: 0.25rem;">
                    <div class="row">
                        <div class="col-md-10">
                            <label class="form-check-label" for="flexSwitchCheckReverse">Si ya has refrendado o convalidado previamente marca la casilla</label>
                        </div>
                        <div class="col-md-2" style="text-align: center;">
                            <input name="m_tesoem" class="form-check-input" type="checkbox" id="flexSwitchCheckReverse" style="width: 25px; height: 25px; margin-top: 10px;" value="1">
                        </div>
                    </div>
                    
                    
                </div>
                <div class="mb-3">
                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autofocus autocomplete="name" style="font-weight: bold; font-size: 20px;" placeholder="Nombre(s)" id="nombre"/>
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="mb-3">

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" placeholder="Correo" required style="font-weight: bold; font-size: 20px;" />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">

                            <input id="arch" type="file" name="foto" class="arch" accept="image/*" onchange="document_up(this)">
                            <label id="arch_button" for="arch" class="boton_file row" style="background-color: white; font-weight: bold; width: 100%; padding: 0; height: 45px;">
                                <label id="arch_button" for="arch" class="boton_file btn " style="background-color: #ced4da; font-weight: bold; width: 50%; font-size: 20px;">
                                    Foto
                                </label>
                                <label id="text_file" style="width: 50%; padding-top: 10px; padding-left: 10px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                                    Campo no Obligatorio
                                </label>

                            </label>
                    
                </div>

                <div class="mb-3">
                    <select name="carrera_tesoem" class="form-select" style="font-weight: bold; font-size: 20px;" id="select_carrera" required>
                        <option value="" selected disabled>Carrera deseada del TESOEM </option>

                    </select>
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
                    <div class="row" style="margin-top: 30px; ">
                        <div class="col-md-6" style="text-align: center; margin-bottom: 30px;">
                            
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
