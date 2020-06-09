@component('mail::message')
# Tus credenciales para acceder a {{ config('app.name') }}

Utiliza estas credenciales para acceder al sistema.

@component('mail::table')
    | Username | Contraseña |
    |:---------|:-----------|
    | {{ $user->email}} | {{ $password }} |
    
@endcomponent

@component('mail::button', ['url' => url('login')])
Inicio de Sessión
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
