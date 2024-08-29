<?php

namespace Modules\Admin\Filament\Resources;

use Filament\Forms\Components\Section;
use Modules\Admin\Filament\Resources\WakafCmsResource\Pages;
use Modules\Admin\Filament\Resources\WakafCmsResource\RelationManagers;
use Modules\Admin\Models\WakafCms;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WakafCmsResource extends Resource
{
    protected static ?string $model = WakafCms::class;

    protected static ?string $navigationIcon = 'hugeicons-alms';
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
                        ->autosize()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul'),
                Tables\Columns\TextColumn::make('description')
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
            'index' => Pages\ListWakafCms::route('/'),
            'create' => Pages\CreateWakafCms::route('/create'),
            'edit' => Pages\EditWakafCms::route('/{record}/edit'),
        ];
    }
    public static function getBreadcrumb(): string
    {
        return 'Wakaf Cms';
    }
}
