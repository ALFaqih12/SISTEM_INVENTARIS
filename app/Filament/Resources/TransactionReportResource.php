<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionReportResource\Pages;
use App\Filament\Resources\TransactionReportResource\RelationManagers;
use App\Models\InventoryTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionReportResource extends Resource
{
    protected static ?string $model = InventoryTransaction::class;

    protected static ?string $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Laporan Transaksi';

    protected static ?string $modelLabel = 'Laporan Transaksi';

    protected static ?string $pluralModelLabel = 'Laporan Transaksi';

    protected static ?int $navigationSort = 9;

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
                Tables\Columns\TextColumn::make('transaction_number')
                    ->label('No Transaksi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Tanggal')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('transactionType.transaction_type_name')
                    ->label('Jenis Transaksi'),

                Tables\Columns\TextColumn::make('source_of_founds')
                    ->label('Sumber Dana'),

                Tables\Columns\TextColumn::make('total_budget')
                    ->label('Anggaran')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('budget_realization')
                    ->label('Realisasi')
                    ->money('IDR'),
            ])

            ->filters([
                Tables\Filters\Filter::make('transaction_date')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function ($query, array $data) {

                        return $query
                            ->when(
                                $data['from'],
                                fn ($query, $date) =>
                                    $query->whereDate(
                                        'transaction_date',
                                        '>=',
                                        $date
                                    )
                            )
                            ->when(
                                $data['until'],
                                fn ($query, $date) =>
                                    $query->whereDate(
                                        'transaction_date',
                                        '<=',
                                        $date
                                    )
                            );
                    }),
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
                    ->url(fn () => route('transaction-report.pdf'))
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
            'index' => Pages\ListTransactionReports::route('/'),
        ];
    }
}
