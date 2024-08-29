<?php

namespace Modules\Admin\Filament\Resources;

use Modules\Admin\Filament\Resources\GalleryResource\Pages;
use Modules\Admin\Filament\Resources\GalleryResource\RelationManagers;
use Modules\Admin\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'solar-gallery-bold';

    protected static ?string $navigationLabel = 'Gallery';

    protected static ?string $navigationGroup = 'Menu Utama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->required()
                        ->label('Title'),
                    FileUpload::make('image')
                        ->required()
                        ->label('Upload Image')
                        ->maxSize('5120')
                        ->image()
                        ->imageEditor()
                        ->disk('public')
                        ->directory('gallery')
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('gallery')) {
                                Storage::disk('public')->makeDirectory('gallery');
                            }
                            $image->toWebp(quality: 100)->save("storage/{$path}");
                            return $path;
                        })
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                ImageColumn::make('image')
                    ->circular()
                    ->label('Foto Gallery'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Gallery')
                        ->modalDescription('Apakah anda yakin ingin menghapus gallery ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function (Gallery $gallery) {
                            if (isset($gallery->image)) {
                                Storage::disk('public')->delete($gallery->image);
                            }
                        }),
                ])->link()->icon('heroicon-s-pencil'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Gallery')
                        ->modalDescription('Apakah anda yakin ingin menghapus gallery ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function (Gallery $galleries) {
                            foreach ($galleries as $gallery) {
                                if (isset($gallery->image)) {
                                    Storage::disk('public')->delete($gallery->image);
                                }
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('No Gallery Found')
            ->emptyStateIcon('solar-gallery-bold');
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Gallery';
    }
}
