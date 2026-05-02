<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class Register extends BaseRegister
{
    public function form(Schema $schema): schema
    {
        return $schema->schema([
            TextInput::make('login')
                ->label('Логин')
                ->required()
                ->minLength(6)
                ->autocomplete('username')
                ->regex('/^[а-яёА-ЯЁ]+$/u')
                ->validationMessages([
                    'regex' => 'Логин должен содержать только символы кириллицы.',
                    'min' => 'Логин должен быть не короче 6 символов.',
                ])
                ->unique('users', 'login'),

            TextInput::make('name')
                ->label('ФИО')
                ->required()
                ->regex('/^[а-яёА-ЯЁ\s]+$/u')
                ->validationMessages([
                    'regex' => 'ФИО должно содержать только кириллицу и пробелы.',
                ]),

            TextInput::make('phone')
                ->label('Телефон')
                ->required()
                ->tel()
                ->mask('+7(999)-999-99-99')
                ->placeholder('+7(XXX)-XXX-XX-XX')
                ->regex('/^\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}$/')
                ->validationMessages([
                    'regex' => 'Телефон должен быть в формате +7(XXX)-XXX-XX-XX.',
                ])
                ->unique('users', 'phone'),

            TextInput::make('email')
                ->label('Почта')
                ->email()
                ->required()
                ->unique('users', 'email'),

            $this->getPasswordFormComponent()
                ->label('Пароль')
                ->minLength(6)
                ->validationMessages([
                    'min' => 'Пароль должен быть не короче 6 символов.',
                ]),

            $this->getPasswordConfirmationFormComponent()
                ->label('Подтверждение пароля'),
        ]);
    }
}
