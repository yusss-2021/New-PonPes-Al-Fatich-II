<?php

namespace Modules\Admin\Filament\Resources;

use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\ImageColumn;
use Intervention\Image\ImageManager;
use Modules\Admin\Filament\Resources\ProgramResource\Pages;
use Modules\Admin\Filament\Resources\ProgramResource\RelationManagers;
use Modules\Admin\Models\Program;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Menu Utama';
    protected static ?string $navigationLabel = 'Program';

    protected static ?string $title = 'Program';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required(true),
                        Grid::make()->schema([
                            DateTimePicker::make('ended_at')
                                ->label('Berakhir Pada')
                                ->native(false),
                            Toggle::make('featured')
                                ->label('Tampilkan Di Halaman Utama')
                                ->onColor('success')
                                ->offColor('danger')
                                ->default(false)
                                ->inline(false),
                        ])->columnSpanFull(),
                        Textarea::make('description')
                            ->required()
                            ->label('Deskripsi'),
                        FileUpload::make('image')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->maxSize(2048)
                            ->label('Upload Thumbnail Program')
                            ->directory('program')
                            ->visibility('public')
                            ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                                $manager = ImageManager::gd();

                                $image = $manager->read($file);
                                $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                                if (!Storage::disk('public')->exists('program')) {
                                    Storage::disk('public')->makeDirectory('program');
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
                    ->sortable()
                    ->label('Judul'),
                TextColumn::make('description')
                    ->limit(20)
                    ->label('Deskripsi'),
                ImageColumn::make('image')
                    ->circular()
                    ->label('Thumbnail Program')
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Program')
                        ->modalDescription('Apakah anda yakin ingin menghapus program ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function (Program $program) {
                            if (isset($program->image)) {
                                Storage::disk('public')->delete($program->image);
                            }
                        }),
                ])
                    ->link()
                    ->label('Actions')
                    ->icon('heroicon-s-pencil')
                    ->label('Aksi')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Program')
                        ->modalDescription('Apakah anda yakin ingin menghapus program ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function () {
                            $records = Program::all();
                            foreach ($records as $program) {
                                if (isset($program->image)) {
                                    Storage::disk('public')->delete($program->image);
                                }
                            }
                        }),
                ])
            ]);
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Program';
    }
}
