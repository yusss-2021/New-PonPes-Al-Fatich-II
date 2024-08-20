<?php

namespace Modules\Admin\Filament\Resources;

use Doctrine\DBAL\Driver\IBMDB2\Driver;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\ImageColumn;
use Intervention\Image\ImageManager;
use Modules\Admin\Filament\Resources\ProgramResource\Pages;
use Modules\Admin\Filament\Resources\ProgramResource\RelationManagers;
use Modules\Admin\Models\Program;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Program')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required(true),
                        Textarea::make('description')
                            ->required(),
                        FileUpload::make('image')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->maxSize(2048)
                            ->label('Upload Image')
                            ->directory('program')
                            ->visibility('public')
                            ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                                $manager = ImageManager::gd();

                                $image = $manager->read($file);
                                $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                                $image->toWebp(quality: 10)->save('storage/' . $path);
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
                    ->sortable(),
                TextColumn::make('description')
                    ->limit(20),
                ImageColumn::make('image')
                    ->circular()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(function (Model $record, array $data): Model {
                        $program = Program::find($record->id)->first();
                        if (file_exists('storage/' . $program->image)) {
                            Storage::disk('public')->delete($program->image);
                        }
                        $record->update($data);

                        return $record;
                    }),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Program $program) {
                        if (isset($program->image)) {
                            Storage::disk('public')->delete($program->image);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function () {
                            $records = Program::all();
                            foreach ($records as $program) {
                                if (isset($program->image)) {
                                    Storage::disk('public')->delete($program->image);
                                }
                            }
                        }),
                ]),
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
}
