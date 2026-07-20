<?php

namespace App\Filament\Resources\SiteSettingResource\Pages;

use App\Filament\Resources\SiteSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteSetting extends EditRecord
{

    protected static string $resource = SiteSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['hero_image_value'])) {
            $data['value'] = $data['hero_image_value'];
            unset($data['hero_image_value']);
        }
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
