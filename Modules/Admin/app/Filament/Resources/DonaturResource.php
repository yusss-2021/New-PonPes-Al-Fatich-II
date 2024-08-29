<?php

namespace Modules\Admin\Filament\Resources;

use Modules\Admin\Filament\Resources\DonaturResource\Pages;
use Modules\Admin\Filament\Resources\DonaturResource\RelationManagers;
use Modules\Admin\Models\Donatur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class DonaturResource extends Resource
{
    protected static ?string $model = Donatur::class;

    protected static ?string $navigationIcon = 'fas-users';
    protected static ?string $navigationLabel = 'Donatur';
    protected static ?string $navigationGroup = 'Menu Utama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('No. Telepon'),
                TextColumn::make('wakaf.title')
                    ->label('Wakaf'),
                TextColumn::make('payment.transaction_id')
                    ->label('Id. Transaksi'),
                TextColumn::make('payment.amount')
                    ->label('Jumlah Traksaksi')
                    ->numeric(locale: 'id')
                    ->money('IDR', true),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('Hapus Data')
                    ->modalDescription('Apakah anda yakin ingin menghapus data ini?')
                    ->modalCancelActionLabel('Batal')
                    ->modalSubmitActionLabel('Ya, Saya yakin'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading('Hapus Data')
                        ->modalDescription('Apakah anda yakin ingin menghapus data ini?')
                        ->modalCancelActionLabel('Batal')
                        ->modalSubmitActionLabel('Ya, Saya yakin'),
                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()
                                ->fromTable()
                                ->withFilename(fn($resource) => 'Data-Wakaf-' . date('Y-m-d H:i:s'))
                        ])
                        ->label('Export Ke Excel'),
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
            'index' => Pages\ListDonaturs::route('/'),
            'create' => Pages\CreateDonatur::route('/create'),
            'edit' => Pages\EditDonatur::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Donatur';
    }
}
