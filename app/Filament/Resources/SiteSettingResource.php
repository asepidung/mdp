<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{

    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $navigationLabel = 'Profil & Info Toko';
    protected static ?string $modelLabel = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Profil & Info Toko';
    protected static ?string $slug = 'info-toko';

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
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Jenis Pengaturan')
                            ->disabled() // So they can't change the key
                            ->required(),
                        Forms\Components\Textarea::make('value')
                            ->label('Isi (Nilai)')
                            ->required()
                            ->rows(5),
                    ])->columns(1),
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
            ]);
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
