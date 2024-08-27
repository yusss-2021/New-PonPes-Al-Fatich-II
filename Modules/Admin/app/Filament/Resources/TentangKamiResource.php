<?php

namespace Modules\Admin\Filament\Resources;

use Modules\Admin\Filament\Resources\TentangKamiResource\Pages;
use Modules\Admin\Filament\Resources\TentangKamiResource\RelationManagers;
use Modules\Admin\Models\TentangKamiCms;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;

class TentangKamiResource extends Resource
{
    protected static ?string $model = TentangKamiCms::class;

    protected static ?string $navigationIcon = 'si-aboutdotme';

    protected static ?string $navigationGroup = 'CMS';

    protected static ?string $navigationLabel = 'Tentang Kami Cms';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('title')
                            ->label('Judul'),
                        TextInput::make('slug')
                            ->label('Sub Judul'),
                    ])->columns(2),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->autosize(),
                    FileUpload::make('image')
                        ->label('Upload Thumbnail Tentang Kami')
                        ->maxSize(2048)
                        ->disk('public')
                        ->directory('cms/tentang-kami')
                        ->image()
                        ->imageEditor()
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('cms/tentang-kami')) {
                                Storage::disk('public')->makeDirectory('cms/tentang-kami');
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
                    ->label('Judul'),
                TextColumn::make('slug')
                    ->label('Sub Judul'),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(30),
                ImageColumn::make('image')
                    ->circular()
                    ->label('Thumbnail Tentang Kami')
                    ->alignCenter()
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
            'index' => Pages\ListTentangKami::route('/'),
            'create' => Pages\CreateTentangKami::route('/create'),
            'edit' => Pages\EditTentangKami::route('/{record}/edit'),
        ];
    }

    public static function getRoutePrefix(): string
    {
        return 'tentang-kami';
    }
}
