<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryRoomResource\Pages;
use App\Filament\Resources\InventoryRoomResource\RelationManagers;
use App\Models\InventoryRoom;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryRoomResource extends Resource
{
    protected static ?string $model = InventoryRoom::class;

    protected static ?string $navigationGroup = 'Inventory Management';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',])
                    ->default('active'),
                Forms\Components\DatePicker::make('inventory_date')
                    ->required(),
                Forms\Components\Select::make('inventory_id')
                    ->label('Barang')
                    ->relationship('inventory', 'inventory_id')
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) =>
                            "{$record->item->item_name} ({$record->quantity} Unit)"
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('room_id')
                    ->relationship('room', 'room_name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('inventory_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('room_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListInventoryRooms::route('/'),
            'create' => Pages\CreateInventoryRoom::route('/create'),
            'edit' => Pages\EditInventoryRoom::route('/{record}/edit'),
        ];
    }
}
