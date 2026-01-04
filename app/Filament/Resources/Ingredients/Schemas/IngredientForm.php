<?php

namespace App\Filament\Resources\Ingredients\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class IngredientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nom de l’ingrédient')
                    ->placeholder('ex: Farine, Sucre, Sel...')
                    ->required()
                    ->maxLength(255),

                // Remplacer le TextInput par un Select pour les unités courantes
                // ou utiliser un TextInput avec des suggestions (datalist)
                TextInput::make('unit')
                    ->label('Unité de mesure')
                    ->placeholder('ex: g, ml, kg, càs...')
                    ->datalist([
                        'g',
                        'kg',
                        'ml',
                        'cl',
                        'L',
                        'càs', // Cuillère à soupe
                        'càc', // Cuillère à café
                        'pincée',
                        'unité',
                    ]),
            ]);
    }
}
