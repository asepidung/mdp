<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    use Translatable;

    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Testimoni')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('rating')
                            ->label('Rating (Bintang)')
                            ->options([
                                5 => '5 Bintang (⭐⭐⭐⭐⭐)',
                                4 => '4 Bintang (⭐⭐⭐⭐)',
                                3 => '3 Bintang (⭐⭐⭐)',
                                2 => '2 Bintang (⭐⭐)',
                                1 => '1 Bintang (⭐)',
                            ])
                            ->default(5)
                            ->required(),
                        Forms\Components\Textarea::make('content')
                            ->label('Isi Ulasan')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true)
                            ->required(),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('content')
                    ->label('Ulasan')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diubah')
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
