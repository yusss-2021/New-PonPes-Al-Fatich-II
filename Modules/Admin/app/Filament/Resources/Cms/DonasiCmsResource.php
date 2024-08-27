<?php

namespace Modules\Admin\Filament\Resources\Cms;

use Modules\Admin\Filament\Resources\Cms\DonasiCmsResource\Pages;
use Modules\Admin\Filament\Resources\DonasiCmsResource\RelationManagers;
use Modules\Admin\Models\CmsModels\DonasiCms;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonasiCmsResource extends Resource
{
    protected static ?string $model = DonasiCms::class;

    protected static ?string $navigationIcon = 'fas-donate';
    protected static ?string $navigationLabel = 'Donasi Cms';
    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul'),
                    Forms\Components\Textarea::make('description')
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
                    ->limit(30),
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
            'index' => Pages\ListDonasiCms::route('/'),
            'create' => Pages\CreateDonasiCms::route('/create'),
            'edit' => Pages\EditDonasiCms::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Donasi Cms';
    }
}
