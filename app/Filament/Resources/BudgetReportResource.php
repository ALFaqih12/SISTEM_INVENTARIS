<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BudgetReportResource\Pages;
use App\Filament\Resources\BudgetReportResource\RelationManagers;
use App\Models\InventoryTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BudgetReportResource extends Resource
{

    protected static ?string $model = InventoryTransaction::class;

    protected static ?string $navigationGroup = 'Reports';

    protected static ?string $navigationLabel = 'Laporan Anggaran';

    protected static ?int $navigationSort = 11;

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
                    ->label('No Transaksi'),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Tanggal')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('source_of_founds')
                    ->label('Sumber Dana'),

                Tables\Columns\TextColumn::make('total_budget')
                    ->label('Anggaran')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('budget_realization')
                    ->label('Realisasi')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('selisih')
                    ->label('Selisih')
                    ->state(function ($record) {
                        return $record->total_budget - $record->budget_realization;
                    })
                    ->money('IDR'),

            ])
            ->filters([
                Tables\Filters\Filter::make('Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn ($query, $date) =>
                                $query->whereDate('transaction_date', '>=', $date)
                            )
                            ->when(
                                $data['until'],
                                fn ($query, $date) =>
                                $query->whereDate('transaction_date', '<=', $date)
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
                    ->url(fn () => route('budget-report.pdf'))
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
            'index' => Pages\ListBudgetReports::route('/'),
        ];
    }
}
