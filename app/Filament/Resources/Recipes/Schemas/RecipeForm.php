<?php

namespace App\Filament\Resources\Recipes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RecipeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informations de la recette')
                    ->description('Détails principaux de la préparation')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('prep_time'),
                        TextInput::make('portions')
                            ->numeric(),
                        FileUpload::make('picture')
                            ->image() // Indique que c'est une image
                            ->directory('recipes') // Les images iront dans storage/app/public/recipes
                            ->imageEditor() // Permet de recadrer l'image après l'upload
                            ->required(),
                        TextInput::make('average_rating')
                            ->required()
                            ->numeric()
                            ->default(0.0)
                            ->disabled(),
                    ])->columns(2),

                Section::make('Relations & Catégories')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('type_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])->columns(2),
                Section::make('Ingrédients')
                    ->schema([

                        CheckboxList::make('ingredients')
                            ->relationship('ingredients', 'name')
                            ->searchable()
                            ->columns(3)
                            ->required(),
                    ]),
            ]);
    }
}
