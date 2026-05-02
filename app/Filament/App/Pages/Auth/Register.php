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
                ->required()
                ->label('Логин')
                ->autocomplete()
                ->unique('users', 'login'),
            TextInput::make('name')
                ->label('ФИО')
                ->required(),
            TextInput::make('email')
                ->label('Почта')
                ->email()
                ->required()
                ->unique('users', 'email'),
            $this->getPasswordFormComponent()
                ->label('Пароль'),
            $this->getPasswordConfirmationFormComponent()
                ->label('Подтвержденик пароля'),
        ]);
    }
}
