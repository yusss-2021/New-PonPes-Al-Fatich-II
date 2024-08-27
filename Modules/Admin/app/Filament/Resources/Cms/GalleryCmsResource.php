<?php

namespace Modules\Admin\Filament\Resources\Cms;

use Modules\Admin\Filament\Resources\Cms\GalleryCmsResource\Pages;
use Modules\Admin\Filament\Resources\GalleryCmsResource\RelationManagers;
use Modules\Admin\Models\CmsModels\GalleryCms;
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

class GalleryCmsResource extends Resource
{
    protected static ?string $model = GalleryCms::class;

    protected static ?string $navigationIcon = 'grommet-gallery';

    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label('Judul'),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->autosize(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(30)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGalleryCms::route('/'),
            'create' => Pages\CreateGalleryCms::route('/create'),
            'edit' => Pages\EditGalleryCms::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Galeri Cms';
    }
}
