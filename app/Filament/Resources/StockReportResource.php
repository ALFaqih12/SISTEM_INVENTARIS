<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockReportResource\Pages;
use App\Filament\Resources\StockReportResource\RelationManagers;
use App\Models\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StockReportResource extends Resource
{
    protected static ?string $model = Inventory::class;

     protected static ?string $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Laporan Stok';

    protected static ?string $modelLabel = 'Laporan Stok';

    protected static ?string $pluralModelLabel = 'Laporan Stok';

    protected static ?int $navigationSort = 10;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Tables\Columns\TextColumn::make('barcode')
                    ->label('Barcode')
                    ->searchable(),

                Tables\Columns\TextColumn::make('item.item_name')
                    ->label('Nama Barang')
                    ->searchable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Qty'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),

                Tables\Columns\TextColumn::make('expired_date')
                    ->label('Expired')
                    ->date('d M Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn () => route('stock-report.pdf'))
                    ->openUrlInNewTab(),

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
            'index' => Pages\ListStockReports::route('/'),
        ];
    }
}
