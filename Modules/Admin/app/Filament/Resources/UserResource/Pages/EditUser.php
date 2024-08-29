<?php

namespace Modules\Admin\Filament\Resources\UserResource\Pages;

use Modules\Admin\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {

        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label('Name')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->type('email'),
                    Select::make('roles')
                        ->label('Hak Akses')
                        ->relationship('roles', 'name')
                        ->multiple()
                        ->preload()
                ])
            ]);
    }
}
