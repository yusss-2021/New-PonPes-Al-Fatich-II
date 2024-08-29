<?php

namespace Modules\Admin\Filament\Resources;

use Modules\Admin\Filament\Resources\AboutCmsResource\Pages;
use Modules\Admin\Filament\Resources\AboutCmsResource\RelationManagers;
use Modules\Admin\Models\AboutCms;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutCmsResource extends Resource
{
    protected static ?string $model = AboutCms::class;

    protected static ?string $navigationIcon = 'si-aboutdotme';
    protected static ?string $navigationLabel  = 'Tentang Kami';
    protected static ?string $navigationGroup = 'Menu Utama';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label('Judul Tentang Kami'),
                    Textarea::make('content')
                        ->label('Konten')
                        ->autosize()
                ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Tentang Kami'),
                TextColumn::make('content')
                    ->limit('30')
                    ->label('Kontent')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Konten')
                    ->modalDescription('Anda tidak dapat mengembalikan data ini setelah anda menghapus-nya!')
                    ->modalCancelActionLabel('Batal')
                    ->modalSubmitActionLabel('Hapus')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
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
            'index' => Pages\ListAboutCms::route('/'),
            'create' => Pages\CreateAboutCms::route('/create'),
            'edit' => Pages\EditAboutCms::route('/{record}/edit'),
        ];
    }
    public static function getBreadCrumb(): string
    {
        return 'Tentang Kami';
    }
}
