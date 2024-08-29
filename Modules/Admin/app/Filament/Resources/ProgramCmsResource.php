<?php

namespace Modules\Admin\Filament\Resources;

use Modules\Admin\Filament\Resources\ProgramCmsResource\Pages;
use Modules\Admin\Filament\Resources\ProgramCmsResource\RelationManagers;
use Modules\Admin\Models\ProgramCms;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramCmsResource extends Resource
{
    protected static ?string $model = ProgramCms::class;

    protected static ?string $navigationIcon = 'clarity-event-solid-badged';
    protected static ?string $navigationGroup = 'CMS';
    protected static ?string $title = 'Program Cms';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label('Judul Program')
                        ->required(),
                    Textarea::make('description')
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
                    ->label('Judul Program'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit('30')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ])
            ->emptyStateHeading('Tidak ada data');
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
            'index' => Pages\ListProgramCms::route('/'),
            'create' => Pages\CreateProgramCms::route('/create'),
            'edit' => Pages\EditProgramCms::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Program Cms';
    }
}
