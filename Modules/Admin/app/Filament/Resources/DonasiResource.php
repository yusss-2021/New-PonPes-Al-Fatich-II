<?php

namespace Modules\Admin\Filament\Resources;

use Filament\Tables\Columns\ImageColumn;
use Modules\Admin\Filament\Resources\DonasiResource\Pages;
use Modules\Admin\Filament\Resources\DonasiResource\RelationManagers;
use Modules\Admin\Models\Donasi;
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
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;

class DonasiResource extends Resource
{
    protected static ?string $model = Donasi::class;

    protected static ?string $navigationIcon = 'fas-donate';

    protected static ?string $navigationLabel = 'Donasi';

    protected static ?string $navigationGroup = 'Menu Utama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->required()
                        ->label('Judul'),
                    Textarea::make('description')
                        ->required()
                        ->label('Deskripsi'),
                    FileUpload::make('image')
                        ->required()
                        ->image()
                        ->label('Upload Thumbnail Donasi')
                        ->disk('public')
                        ->maxSize(2048)
                        ->directory('donasi')
                        ->imageEditor()
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('donasi')) {
                                Storage::disk('public')->makeDirectory('donasi');
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
                    ->label('Title'),
                TextColumn::make('description')
                    ->limit('20')
                    ->label('Deskripsi'),
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular()
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Donasi')
                        ->modalDescription('Apakah anda yakin ingin menghapus donasi ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function (Donasi $donasi) {
                            if (isset($wakaf->image)) {
                                Storage::disk('public')->delete($donasi->image);
                            }
                        })
                ])->link()->icon('heroicon-s-pencil')->label('Aksi')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Donasi')
                        ->modalDescription('Apakah anda yakin ingin menghapus donasi ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function () {
                            $records = Donasi::all();
                            foreach ($records as $donasi) {
                                if (isset($donasi->image)) {
                                    Storage::disk('public')->delete($donasi->image);
                                }
                            }
                        }),
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
            'index' => Pages\ListDonasis::route('/'),
            'create' => Pages\CreateDonasi::route('/create'),
            'edit' => Pages\EditDonasi::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Donasi';
    }
}
