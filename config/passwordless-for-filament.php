<?php

// config for BrunoPincaro/PasswordlessForFilament
return [
    "model" => \App\Models\User::class, // authentication model to be used
    "magic_link_expiry" => 5, // how long in minutes the magic link should be valid
    "mailable_for_magic_link" => \BrunoPincaro\PasswordlessForFilament\Mail\PasswordlessForFilamentMagicLinkVerification::class, // mailable used to send the magic link verification email
];
