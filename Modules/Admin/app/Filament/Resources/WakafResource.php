<?php

namespace Modules\Admin\Filament\Resources;

use Filament\Forms\Components\DatePicker;
use Modules\Admin\Filament\Resources\WakafResource\Pages;
use Modules\Admin\Filament\Resources\WakafResource\RelationManagers;
use Modules\Admin\Models\Wakaf;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
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

class WakafResource extends Resource
{
    protected static ?string $model = Wakaf::class;

    protected static ?string $navigationIcon = 'hugeicons-alms';
    protected static ?string $navigationGroup = 'Menu Utama';
    protected static ?string $navigationLabel = 'Wakaf';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Title'),
                        TextInput::make('target_amount')
                            ->numeric()
                            ->mask(
                                RawJs::make(<<<'JS'
                                $money($input, {
                                    prefix: 'Rp ',
                                    thousandsSeparator: '.',
                                    decimalSeparator: ',',
                                    precision: 0,
                                    allowNegative: false,
                                });
                            JS)
                            )
                            ->required()
                            ->stripCharacters([',', '.'])
                            ->placeholder('Rp 0')
                            ->label('Target Amount')
                    ]),
                    DateTimePicker::make('end_date')
                        ->required()
                        ->label('End Date')
                        ->native(false)
                        ->timezone('Asia/Jakarta')
                        ->placeholder('Choose Date and Time ...')
                        ->locale('id')
                        ->weekStartsOnSunday(),
                    Textarea::make('description')
                        ->required()
                        ->label('Description')
                        ->autosize(),
                    FileUpload::make('image')
                        ->required()
                        ->label('Upload Image')
                        ->image()
                        ->maxSize(2048)
                        ->imageEditor()
                        ->disk('public')
                        ->directory('wakaf')
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('wakaf')) {
                                Storage::disk('public')->makeDirectory('wakaf');
                            }
                            $image->toWebp(quality: 90)->save("storage/{$path}");
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
                    ->label('Title')
                    ->searchable(),
                TextColumn::make('target_amount')
                    ->label('Target Amount')
                    ->money('IDR', true),
                TextColumn::make('end_date')
                    ->label('End Date')
                    ->searchable(),
                TextColumn::make('created_at')->label('Created At'),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(20),
                ImageColumn::make('image')
                    ->label('Image')
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
                        ->modalHeading('Hapus Wakaf')
                        ->modalDescription('Apakah anda yakin ingin menghapus wakaf ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function (Wakaf $wakaf) {
                            if (isset($wakaf->image)) {
                                Storage::disk('public')->delete($wakaf->image);
                            }
                        })
                ])
                    ->link()
                    ->label('Actions')
                    ->icon('heroicon-s-pencil'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Wakaf')
                        ->modalDescription('Apakah anda yakin ingin menghapus wakaf ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function () {
                            $records = Wakaf::all();
                            foreach ($records as $wakaf) {
                                if (isset($wakaf->image)) {
                                    Storage::disk('public')->delete($wakaf->image);
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
            'index' => Pages\ListWakafs::route('/'),
            'create' => Pages\CreateWakaf::route('/create'),
            'edit' => Pages\EditWakaf::route('/{record}/edit'),
        ];
    }
}
