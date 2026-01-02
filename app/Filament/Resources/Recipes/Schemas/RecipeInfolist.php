<?php

namespace App\Filament\Resources\Recipes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RecipeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('prep_time')
                    ->placeholder('-'),
                TextEntry::make('portions')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('picture')
                    ->placeholder('-'),
                TextEntry::make('average_rating')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('type_id')
                    ->numeric(),
            ]);
    }
}
