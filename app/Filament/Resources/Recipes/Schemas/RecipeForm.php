<?php

namespace App\Filament\Resources\Recipes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RecipeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('prep_time'),
                TextInput::make('portions')
                    ->numeric(),
                TextInput::make('picture'),
                TextInput::make('average_rating')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('type_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
