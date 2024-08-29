<?php

namespace Modules\Admin\Filament\Resources;

use Modules\Admin\Filament\Resources\CategoryBlogResource\Pages;
use Modules\Admin\Filament\Resources\CategoryBlogResource\RelationManagers;
use Modules\Admin\Models\CategoryBlog;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryBlogResource extends Resource
{
    protected static ?string $model = CategoryBlog::class;

    protected static ?string $navigationIcon = 'iconsax-lin-category';
    protected static ?string $navigationLabel = 'Kategori';
    protected static ?string $navigationGroup = 'Menu Utama';
    protected static ?string $navigationParentItem = 'Blog';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->required()
                        ->label('Nama Kategori'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Kategori Blog')
                        ->modalDescription('Apakah anda yakin ingin menghapus kategori blog ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan'),
                ])->link()->icon('heroicon-s-pencil')->label('Aksi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Kategori Blog')
                        ->modalDescription('Apakah anda yakin ingin menghapus kategori blog ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan'),
                ]),
            ])
            ->emptyStateHeading('No category blogs found');
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
            'index' => Pages\ListCategoryBlogs::route('/'),
            'create' => Pages\CreateCategoryBlog::route('/create'),
            'edit' => Pages\EditCategoryBlog::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Kategori Blog';
    }
}
