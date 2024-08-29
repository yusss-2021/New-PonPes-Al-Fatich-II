<?php

namespace Modules\Admin\Filament\Resources;

use Modules\Admin\Filament\Resources\TransaksiResource\Pages;
use Modules\Admin\Filament\Resources\TransaksiResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Admin\Models\Payment;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class TransaksiResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'solar-wallet-money-bold';

    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?string $navigationLabel = 'Transaksi';

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
                TextColumn::make('transaction_id')
                    ->label('Id Transaksi')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->numeric(locale: 'id')
                    ->money('IDR', true),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->modalHeading('Hapus Transaksi')
                    ->modalDescription('Apakah anda yakin ingin menghapus transaksi ini?')
                    ->modalCancelActionLabel('Batal')
                    ->modalSubmitActionLabel('Ya, Saya yakin'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->modalHeading('Hapus Transaksi')
                        ->modalDescription('Apakah anda yakin ingin menghapus transaksi ini?')
                        ->modalCancelActionLabel('Batal')
                        ->modalSubmitActionLabel('Ya, Saya yakin'),
                    ExportBulkAction::make()
                        ->label('Ekspor Ke Excel')
                        ->exports([
                            ExcelExport::make()
                                ->fromTable()
                                ->only(['transaction_id', 'amount', 'created_at'])
                                ->withFilename(fn($resource) => 'Transaksi - ' . date('Y-m-d H:i:s'))
                        ]),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }

    public static function getBreadcrumb(): string
    {
        return 'Transaksi';
    }
}
