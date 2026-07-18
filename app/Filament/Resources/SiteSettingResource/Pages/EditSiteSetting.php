<?php

namespace App\Filament\Resources\SiteSettingResource\Pages;

use App\Filament\Resources\SiteSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteSetting extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = SiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
