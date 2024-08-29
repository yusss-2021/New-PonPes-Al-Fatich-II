<?php

namespace Modules\Admin\Filament\Resources;

use App\Models\User;
use Modules\Admin\Filament\Resources\UserResource\Pages;
use Modules\Admin\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'fas-user';
    protected static ?string $navigationGroup = 'Hak Akses & User';
    protected static ?string $navigationLabel = 'User';
    protected static ?string $title = 'User';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label('Nama')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email')
                        ->required()
                        ->type('email'),
                    TextInput::make('password')
                        ->required()
                        ->minLength(6)
                        ->label('Password')
                        ->revealable()
                        ->password()
                        ->type('password'),
                    TextInput::make('password-confirmation')
                        ->same('password')
                        ->password()
                        ->revealable()
                        ->label('Konfirmasi Password')
                        ->type('password'),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'User';
    }

    public static function getNavigationBadge(): ?string
    {
        return User::count();
    }
}
