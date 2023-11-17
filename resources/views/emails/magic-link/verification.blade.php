<x-mail::message>
    # {{ __('passwordless-for-filament::mail.verify_and_login') }}

    {{ __('passwordless-for-filament::mail.verify_message', ['appName' => config('app.name'), 'email' => $email, 'expiry' => $expiry]) }}

    <x-mail::button :url="$url">
        {{ __('passwordless-for-filament::mail.verify_and_login') }}
    </x-mail::button>

    {{ __('passwordless-for-filament::mail.ignore_if_not_requested') }}

    {{ __('passwordless-for-filament::mail.alternate_link', ['url' => $url]) }}

    {{ __('passwordless-for-filament::mail.thanks') }},<br>

    {{ config('app.name') }}
</x-mail::message>