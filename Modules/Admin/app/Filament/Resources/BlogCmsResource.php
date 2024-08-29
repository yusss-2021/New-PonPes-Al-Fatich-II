<?php

namespace Modules\Admin\Filament\Resources;

use Filament\Tables\Columns\ImageColumn;
use Modules\Admin\Filament\Resources\BlogCmsResource\Pages;
use Modules\Admin\Filament\Resources\BlogCmsResource\RelationManagers;
use Modules\Admin\Models\BlogCms;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;

class BlogCmsResource extends Resource
{
    protected static ?string $model = BlogCms::class;

    protected static ?string $navigationIcon = 'bxs-news';
    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label('Judul'),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->autosize(),
                    FileUpload::make('image')
                        ->label('Upload Thumbnail Blog Section')
                        ->image()
                        ->disk('public')
                        ->directory('cms/blog_thumbnail')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('cms/blog_thumbnail')) {
                                Storage::disk('public')->makeDirectory('cms/blog_thumbnail');
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
                TextColumn::make('description')
                    ->label('Deskripsi'),
                ImageColumn::make('image')
                    ->label('Thumbnail Blog Section')
                    ->circular()
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
            'index' => Pages\ListBlogCms::route('/'),
            'create' => Pages\CreateBlogCms::route('/create'),
            'edit' => Pages\EditBlogCms::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Blog Cms';
    }
}
