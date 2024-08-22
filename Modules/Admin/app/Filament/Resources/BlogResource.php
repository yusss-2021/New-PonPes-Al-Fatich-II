<?php

namespace Modules\Admin\Filament\Resources;

use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\ViewColumn;
use Modules\Admin\Filament\Resources\BlogResource\Pages;
use Modules\Admin\Filament\Resources\BlogResource\RelationManagers;
use Modules\Admin\Models\Blog;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Modules\Admin\Models\CategoryBlog;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'bxs-news';

    protected static ?string $navigationLabel = 'Blog';

    protected static ?string $navigationGroup = 'Blogs';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make()->schema([
                        TextInput::make('title')
                            ->required()
                            ->label('Judul Blog')
                            ->placeholder('Masukan Judul Blog')
                            ->live(onBlur: true)
                            ->reactive()
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->label('Slug')
                            ->placeholder('otomatis terisi dari judul blog')
                            ->readonly(),
                        Select::make('category_id')
                            ->required()
                            ->label('Kategori')
                            ->options(CategoryBlog::all()->pluck('title', 'id'))
                            ->native(false)
                            ->searchable(),
                        TagsInput::make('tag')
                            ->label('Tag')
                            ->reorderable()
                            ->placeholder('Masukan Tag')
                            ->separator(','),
                    ])->columns(2),
                    FileUpload::make('attachment')
                        ->required()
                        ->label('Upload Thumbnail')
                        ->image()
                        ->maxSize(5120)
                        ->disk('public')
                        ->directory('blogs')
                        ->imageEditor()
                        ->saveUploadedFileUsing(function (FileUpload $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('blogs')) {
                                Storage::disk('public')->makeDirectory('blogs');
                            }
                            $image->toWebp(quality: 100)->save("storage/{$path}");
                            return $path;
                        }),
                    RichEditor::make('content')
                        ->required()
                        ->label('Isi Blog')
                        ->disableToolbarButtons([
                            'codeBlock',
                        ])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('blogs/content')
                        ->saveUploadedFileAttachmentsUsing(function (RichEditor $component, $file) {
                            $manager = ImageManager::gd();
                            $image = $manager->read($file);
                            $path = $component->getFileAttachmentsDirectory() . '/' . Uuid::uuid4()->toString() . '.webp';
                            if (!Storage::disk('public')->exists('blogs/content')) {
                                Storage::disk('public')->makeDirectory('blogs/content');
                            }
                            $image->toWebp(quality: 100)->save("storage/{$path}");
                            return $path;
                        }),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Blog')
                    ->searchable(),
                TextColumn::make('category.title')
                    ->label('Kategori')
                    ->searchable(),
                ViewColumn::make('tag')->view('admin::filament.tables.columns.blog-tags-column'),
                ImageColumn::make('attachment')
                    ->label('Thumbnail')
                    ->circular()
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Dibuat'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Diupdate'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Blog')
                        ->modalDescription('Apakah anda yakin ingin menghapus blog ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function (Blog $blog) {
                            if ($blog->attachment) {
                                Storage::disk('public')->delete($blog->attachment);
                            }
                            $imageContent = $blog->content;
                            preg_match('/<img[^>]+src="([^">]+)"/', $imageContent, $matches);
                            $srcUrl = $matches[1];

                            // Ekstrak nama file dengan ekstensi
                            $fileNameWithExtension = basename($srcUrl);

                            // Path ke file di storage
                            $pathToFile = "blogs/content/{$fileNameWithExtension}";

                            // Hapus file
                            if (Storage::disk('public')->exists($pathToFile)) {
                                Storage::disk('public')->delete($pathToFile);
                            }
                        }),
                ])->link()->icon('heroicon-s-pencil')->label('Aksi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus')
                        ->modalHeading('Hapus Blog')
                        ->modalDescription('Apakah anda yakin ingin menghapus blog ini?')
                        ->modalSubmitActionLabel('Ya, Saya yakin')
                        ->modalCancelActionLabel('Tidak, Batalkan')
                        ->before(function (Blog $blogs) {
                            foreach ($blogs as $blog) {
                                if ($blog->attachment) {
                                    Storage::disk('public')->delete($blog->attachment);
                                }

                                $imageContent = $blog->content;
                                preg_match('/<img[^>]+src="([^">]+)"/', $imageContent, $matches);
                                $srcUrl = $matches[1];

                                // Ekstrak nama file dengan ekstensi
                                $fileNameWithExtension = basename($srcUrl);

                                // Path ke file di storage
                                $pathToFile = "blogs/content/{$fileNameWithExtension}";

                                // Hapus file
                                if (Storage::disk('public')->exists($pathToFile)) {
                                    Storage::disk('public')->delete($pathToFile);
                                }
                            }
                        }),
                ]),
            ])
            ->emptyStateHeading('Tidak Ada Blog Yang Tersedia')
            ->emptyStateIcon('bxs-news');
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Blog';
    }
}
