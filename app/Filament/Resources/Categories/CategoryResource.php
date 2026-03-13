<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages;
use App\Models\Category;
use Filament\Resources\Resource;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Kategorie';

    protected static ?string $pluralModelLabel = 'Kategorie';

    // Używamy \Filament\Schemas\Schema, bo Form u Ciebie nie działa (zgodnie ze screenem 2)
public static function form(\Filament\Forms\Form $form): \Filament\Forms\Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nazwa kategorii')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($set, ?string $state) {
                        $set('slug', \Illuminate\Support\Str::slug($state));
                    }),
                
                \Filament\Forms\Components\TextInput::make('slug')
                    ->label('Slug (Link)')
                    ->required()
                    ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Nazwa')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('slug')
                    ->label('Link'),
            ])
            ->filters([])
            // TYMCZASOWO PUSTE AKCJE - to naprawi błąd ze screena 1 i 3
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}