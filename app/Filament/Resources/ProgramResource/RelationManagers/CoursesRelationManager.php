<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CoursesRelationManager extends RelationManager
{
    protected static string $relationship = 'courses';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('credit_units')
                    ->required()
                    ->numeric(),
                    Select::make('year_of_study')
                    ->options(
                        [
                            'Year I' => 'Year I',
                            'Year II' => 'Year II',
                            'Year III' => 'Year III',
                            'Year IV' => 'Year IV'
                        ]),
                Select::make('semester')
                        ->options(
                            [
                                'Semester One' => 'Semester One',
                                'Semester Two' => 'Semester Two',
                                'Recess' => 'Recess Term'
                            ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('credit_units'),
                TextColumn::make('year_of_study'),
                TextColumn::make('semester')->searchable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
