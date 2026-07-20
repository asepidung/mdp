import re

# 1. Update SiteSettingResource.php
with open('app/Filament/Resources/SiteSettingResource.php', 'r', encoding='utf-8') as f:
    resource = f.read()

# Modify form schema
schema_old = """                  Forms\\Components\\Section::make('Ubah Informasi')
                      ->schema([
                          Forms\\Components\\TextInput::make('key')
                              ->label('Jenis Pengaturan')
                              ->disabled() // So they can't change the key
                              ->required(),
                          Forms\\Components\\Textarea::make('value')
                              ->label('Isi (Nilai)')
                              ->required()
                              ->rows(5),
                      ])->columns(1),"""

schema_new = """                  Forms\\Components\\Section::make('Ubah Informasi')
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

resource = resource.replace(schema_old, schema_new)

# Add hero_image to match block
resource = resource.replace("'hero_title' => 'Judul Utama (Hero)',", "'hero_title' => 'Judul Utama (Hero)',\n                                'hero_image' => 'Gambar Utama (Hero)',")

with open('app/Filament/Resources/SiteSettingResource.php', 'w', encoding='utf-8') as f:
    f.write(resource)

# 2. Update DatabaseSeeder.php
with open('database/seeders/DatabaseSeeder.php', 'r', encoding='utf-8') as f:
    seeder = f.read()

seeder = seeder.replace("['key' => 'hero_title', 'value' => 'Rasakan Kelezatan Puding Asli Mbok Dewor'],", "['key' => 'hero_title', 'value' => 'Rasakan Kelezatan Puding Asli Mbok Dewor'],\n            ['key' => 'hero_image', 'value' => ''],")

with open('database/seeders/DatabaseSeeder.php', 'w', encoding='utf-8') as f:
    f.write(seeder)

# 3. Update welcome.blade.php
with open('resources/views/welcome.blade.php', 'r', encoding='utf-8') as f:
    blade = f.read()

blade = blade.replace("{{ asset('assets/img/puding-1.jpg') }}') }}", "{{ !empty($settings['hero_image']) ? Storage::url($settings['hero_image']) : asset('assets/img/puding-1.jpg') }}")

with open('resources/views/welcome.blade.php', 'w', encoding='utf-8') as f:
    f.write(blade)
