<?php

namespace Modules\Admin\Filament\Resources;

use Filament\Tables\Columns\ImageColumn;
use Modules\Admin\Filament\Resources\PageHomeCmsResource\Pages;
use Modules\Admin\Filament\Resources\PageHomeCmsResource\RelationManagers;
use Modules\Admin\Models\PageHomeCms;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;

class PageHomeCmsResource extends Resource
{
    protected static ?string $model = PageHomeCms::class;

    protected static ?string $navigationIcon = 'bxs-carousel';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Judul Konten')
                            ->placeholder('Masukan Judul Konten'),
                        TextInput::make('cta')
                            ->label('Link CTA')
                            ->placeholder('Masukan Link CTA')
                            ->url()
                            ->suffixIcon('heroicon-m-globe-alt'),
                    ]),
                    Textarea::make('description')
                        ->label('Deskripsi Konten')
                        ->placeholder('Masukan Deskripsi Konten'),
                    FileUpload::make('image')
                        ->required()
                        ->image()
                        ->imageEditor()
                        ->maxSize(2048)
                        ->disk('public')
                        ->directory('cms/hero-section')
                        ->label('Upload Thumbnail Hero Section')
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('cms/hero-section')) {
                                Storage::disk('public')->makeDirectory('cms/hero-section');
                            }
                            $image->toWebp(quality: 10)->save("storage/{$path}");
                            return $path;
                        })
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Konten')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Deskripsi Konten')
                    ->getStateUsing(function (PageHomeCms $record, Column $column) {
                        if ($record->description == null) {
                            $column
                                ->badge()
                                ->color('danger');
                            return 'Konten belum ada';
                        }
                        return $record->description;
                    })
                    ->limit(20),
                TextColumn::make('cta')
                    ->label('Link CTA')
                    ->getStateUsing(function (PageHomeCms $record, Column $column) {
                        if ($record->cta == null) {
                            $column
                                ->badge()
                                ->color('danger');
                            return 'Konten belum ada';
                        }
                        return $record->cta;
                    }),
                ImageColumn::make('image')
                    ->circular()
                    ->label('Thumbnail Hero Section')
                    ->alignCenter()
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Konten')
                        ->modalDescription('Apakah anda yakin ingin menghapus konten ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->icon('heroicon-o-trash')
                        ->before(function (PageHomeCms $pageHomeCms) {
                            if (Storage::disk('public')->exists($pageHomeCms->image)) {
                                Storage::disk('public')->delete($pageHomeCms->image);
                            }
                        }),
                ])->link()->label('Aksi')->icon('heroicon-s-pencil'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Hapus')
                        ->modalHeading('Hapus Konten')
                        ->modalDescription('Apakah anda yakin ingin menghapus konten ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->icon('heroicon-o-trash')
                        ->before(function (PageHomeCms $pageHomeCms) {
                            if (Storage::disk('public')->exists($pageHomeCms->image)) {
                                Storage::disk('public')->delete($pageHomeCms->image);
                            }
                        }),
                ]),
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
            'index' => Pages\ListPageHomeCms::route('/'),
            'create' => Pages\CreatePageHomeCms::route('/create'),
            'edit' => Pages\EditPageHomeCms::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Cms Hero Section';
    }

    public static function getRoutePrefix(): string
    {
        return 'cms/hero-section';
    }
}
