<?php

namespace App\Filament\Resources\BudgetReportResource\Pages;

use App\Filament\Resources\BudgetReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBudgetReport extends EditRecord
{
    protected static string $resource = BudgetReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
