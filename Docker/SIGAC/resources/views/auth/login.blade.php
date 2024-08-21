@extends('templates/site')

@section('conteudo')

<div class="text-center">
    <span class="fw-bold text-success fs-2 mb-5">
        Autenticação do Usuário
    </span>
    
    <x-auth-session-status class="mt-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div class="w-75 mx-auto mt-4">
            <x-textbox name="email" label="E-mail" type="email" :value="old('email')" disabled="false"/>
        </div>

        <!-- Password -->
        <div class="w-75 mx-auto">
            <x-textbox name="password" label="Senha" type="password" value="null" disabled="false"/>
        </div>

        <div class="row w-75 mx-auto">
            <!-- Remember Me -->
            <div class="col">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Lembrar') }}</span>
                </label>
            </div>
            @if (Route::has('password.request'))
                <div class="col">
                    <x-button label="Recuperar Senha" type="link" route="password.request" color="secondary"/>
                </div>
            @endif

            <div class="col">
                <x-button label="Entrar" type="submit" route="" color="success"/>
            </div>
        </div>
    </form>
</div>

@endsection
