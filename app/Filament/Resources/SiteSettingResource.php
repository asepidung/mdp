<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SiteSettingResource extends Resource
{

    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'Profil & Info Toko';
    protected static ?string $modelLabel = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Profil & Info Toko';
    protected static ?string $slug = 'info-toko';

    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderByRaw("FIELD(`key`, 'hero_image', 'hero_title', 'hero_description', 'hero_badge', 'about_title', 'about_text', 'whatsapp_number', 'instagram_url', 'google_maps_url', 'address')");
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Ubah Informasi')
                    ->schema(function (?\App\Models\SiteSetting $record) {
                        $fields = [
                            Forms\Components\TextInput::make('key')
                                ->label('Jenis Pengaturan')
                                ->disabled()
                                ->required(),
                        ];

                        if ($record && $record->key === 'hero_image') {
                            $fields[] = Forms\Components\FileUpload::make('value')
                                ->label('Upload Gambar')
                                ->image()
                                ->directory('site-settings')
                                ->required();
                        } else {
                            $fields[] = Forms\Components\Textarea::make('value')
                                ->label('Isi (Nilai)')
                                ->required()
                                ->rows(5);
                        }

                        return $fields;
                    })->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Bagian')
                                          ->formatStateUsing(function ($state) {
                          return match($state) {
                              'whatsapp_number' => 'Nomor WhatsApp',
                              'hero_title' => 'Judul Utama (Hero)',
                                'meta_title' => 'Judul SEO (Google)',
                                'meta_description' => 'Deskripsi SEO (Google)',
                                'hero_image' => 'Gambar Utama (Hero)',
                              'hero_description' => 'Deskripsi Utama (Hero)',
                              'hero_badge' => 'Teks Badge (Hero)',
                              'about_title' => 'Judul Tentang Kami',
                              'about_text' => 'Teks Tentang Kami',
                              'instagram_url' => 'Link Instagram',
                              'google_maps_url' => 'Link Google Maps',
                              'address' => 'Alamat Lengkap',
                              default => $state,
                          };
                      }),
                Tables\Columns\TextColumn::make('value')
                    ->label('Isi (Preview)')
                    ->limit(60),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Removed delete bulk action
            ])
            ->paginated(false);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
