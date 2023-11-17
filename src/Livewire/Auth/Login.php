<?php

namespace BrunoPincaro\PasswordlessForFilament\Livewire\Auth;

use BrunoPincaro\PasswordlessForFilament\PasswordlessForFilament;
use BrunoPincaro\PasswordlessForFilament\PasswordlessForFilamentMagicLink;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * @property ComponentContainer $form
 */
class Login extends Component implements HasForms
{
    use InteractsWithForms;
    use WithRateLimiting;

    public string $email = "";
    public bool $remember = false;
    public bool $submited = false;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label(__('filament::login.fields.email.label'))
                ->email()
                ->required()
                ->autocomplete(),

            Checkbox::make('remember')
                ->label(__('filament::login.fields.remember.label')),
        ];
    }

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }

    public function render(): View
    {
        return view('passwordless-for-filament::login')
            ->layout(
                'filament::components.layouts.card',
                [
                    'title' => __('filament::login.title'),
                ]
            );
    }

    public function authenticate()
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $e) {
            throw ValidationException::withMessages([
                'email' => __(
                    'filament::login.messages.throttled',
                    [
                        'seconds' => $e->secondsUntilAvailable,
                        'minutes' => ceil($e->secondsUntilAvailable / 60),
                    ]
                )
            ]);
        }

        $data = $this->form->getState();
        $model = app(PasswordlessForFilament::class)->getModel($data['email']);

        if(! is_null($model)) {
            $magicLink = PasswordlessForFilamentMagicLink::create($model, $data['remember']);

            $mailableClass = config('passwordless-for-filament.mailable_for_magic_link');

            Mail::to($model->email)
                ->send(
                    new $mailableClass(
                        email: $model->email,
                        magicLink: $magicLink
                    )
                );
        }

        $this->submited = true;
    }
}
