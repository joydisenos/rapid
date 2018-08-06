@component('mail::message')
# Nuevo Restaurante Registrado!

Se ha registrado un restaurante bajo el email {{$user->email}} , a nombre de {{title_case($user->name)}} {{title_case($user->apellido)}}.

@component('mail::button', ['url' => 'https://rapidelly.com'])
Admin
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent
