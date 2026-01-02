<?php

namespace App\Filament\Resources\Recipes\Tables;

use App\Models\Recipe;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RecipesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('prep_time')
                    ->searchable(),
                TextColumn::make('portions')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('picture')
                    ->searchable(),
                TextColumn::make('average_rating')
                    ->numeric(1)
                    ->icon('heroicon-m-star')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('type_id')
                    ->numeric()
                    ->sortable(),
            ])
            ->headerActions([
                // Utilisation simple sans le chemin complet devant
                Action::make('recalculateRatings')
                    ->label('Actualiser les notes')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function () {
                        Recipe::all()->each(function ($recipe) {
                            $recipe->updateAverageRating();
                        });
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
