<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Filament\Resources\CourseResource\RelationManagers\ResultsRelationManager;
use App\Models\Course;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),
                TextInput::make('credit_units')
                    ->numeric()
                    ->required(),
                Select::make('program_id')
                    ->options(
                        Program::get()->pluck('title', 'id')->toArray()
                    )
                    ->searchable(),
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
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('program.title')
                    ->sortable(),
                TextColumn::make('credit_units'),
                TextColumn::make('year_of_study'),
                TextColumn::make('semester')
            ])
            ->filters([
                SelectFilter::make('program_id')
                    ->label('Filter by program')
                    ->relationship('program', 'title')
                    ->searchable(),
                SelectFilter::make('year_of_study')
                    ->label('Filter by year of study')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ResultsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
