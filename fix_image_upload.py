import re

# 1. Update SiteSettingResource.php
filepath = 'app/Filament/Resources/SiteSettingResource.php'
with open(filepath, 'r', encoding='utf-8') as f:
    resource = f.read()

schema_old = """                  Forms\\Components\\Section::make('Ubah Informasi')
                      ->schema(function (?\\App\\Models\\SiteSetting $record) {
                          $fields = [
                              Forms\\Components\\TextInput::make('key')
                                  ->label('Jenis Pengaturan')
                                  ->disabled()
                                  ->required(),
                          ];

                          if ($record && $record->key === 'hero_image') {
                              $fields[] = Forms\\Components\\FileUpload::make('value')
                                  ->label('Upload Gambar')
                                  ->image()
                                  ->directory('site-settings')
                                  ->required();
                          } else {
                              $fields[] = Forms\\Components\\Textarea::make('value')
                                  ->label('Isi (Nilai)')
                                  ->required()
                                  ->rows(5);
                          }

                          return $fields;
                      })->columns(1),"""

schema_new = """                  Forms\\Components\\Section::make('Ubah Informasi')
                      ->schema([
                          Forms\\Components\\TextInput::make('key')
                              ->label('Jenis Pengaturan')
                              ->disabled()
                              ->required(),
                          Forms\\Components\\FileUpload::make('hero_image_value')
                              ->label('Upload Gambar')
                              ->image()
                              ->directory('site-settings')
                              ->required()
                              ->formatStateUsing(fn ($record) => $record?->value)
                              ->visible(fn ($record) => $record?->key === 'hero_image'),
                          Forms\\Components\\Textarea::make('value')
                              ->label('Isi (Nilai)')
                              ->required()
                              ->rows(5)
                              ->visible(fn ($record) => $record?->key !== 'hero_image'),
                      ])->columns(1),"""

resource = resource.replace(schema_old, schema_new)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(resource)

# 2. Update EditSiteSetting.php
filepath = 'app/Filament/Resources/SiteSettingResource/Pages/EditSiteSetting.php'
with open(filepath, 'r', encoding='utf-8') as f:
    edit_file = f.read()

mutate_method = """
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['hero_image_value'])) {
            $data['value'] = $data['hero_image_value'];
            unset($data['hero_image_value']);
        }
        return $data;
    }
"""

if 'mutateFormDataBeforeSave' not in edit_file:
    edit_file = edit_file.replace('    protected function getRedirectUrl(): string', mutate_method + '\n    protected function getRedirectUrl(): string')

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(edit_file)
