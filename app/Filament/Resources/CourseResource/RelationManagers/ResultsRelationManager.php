<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Models\Course;
use App\Models\Student;
use DB;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

class ResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'results';

    protected static ?string $recordTitleAttribute = 'name';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('student_id')
                ->label('Select Student')
                ->options(function (RelationManager $livewire): array {
                    return $livewire->ownerRecord->program->students()
                        ->pluck('name', 'id')
                        ->toArray();
                        })
                    ->searchable()
                    ->unique(callback: function (Unique $rule, RelationManager $livewire) {
                        return $rule->where('course_id', $livewire->ownerRecord->id)
                        ->where('student_id', 1);
                    }, ignoreRecord: true)
                    ->disabledOn('edit'),

                TextInput::make('cat_one')
                    ->numeric(),
                TextInput::make('cat_two')
                    ->numeric(),
                TextInput::make('final_exam')
                    ->numeric(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cat_one')->label('CAT One'),
                Tables\Columns\TextColumn::make('cat_two')->label('CAT Two'),
                Tables\Columns\TextColumn::make('final_exam'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['cat_one'] = ($data['cat_one'] / 100) * 20;
                        $data['cat_two'] = ($data['cat_two'] / 100) * 20;
                        $data['total_cw'] = $data['cat_one'] + $data['cat_two'];
                        $data['final_exam'] = ($data['final_exam'] / 100) * 60;
                        $data['total_mark'] = $data['total_cw'] + $data['final_exam'];

                        if ($data['total_mark'] >= 80) {
                            $data['grade_point'] = 5;
                            $data['letter_grade'] = 'A';
                        } elseif ($data['total_mark'] >= 75) {
                            $data['grade_point'] = 4.5;
                            $data['letter_grade'] = 'B+';
                        } elseif ($data['total_mark'] >= 70) {
                            $data['grade_point'] = 4;
                            $data['letter_grade'] = 'B';
                        } elseif ($data['total_mark'] >= 65) {
                            $data['grade_point'] = 3.5;
                            $data['letter_grade'] = 'C+';
                        } elseif ($data['total_mark'] >= 60) {
                            $data['grade_point'] = 3;
                            $data['letter_grade'] = 'C';
                        } elseif ($data['total_mark'] >= 55) {
                            $data['grade_point'] = 2.5;
                            $data['letter_grade'] = 'D+';
                        } elseif ($data['total_mark'] >= 50) {
                            $data['grade_point'] = 2;
                            $data['letter_grade'] = 'D';
                        } else {
                            $data['grade_point'] = 0;
                            $data['letter_grade'] = 'F';
                        }


                        return $data;
                    }),

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        $data['cat_one'] = ($data['cat_one'] / 20) * 100;
                        $data['cat_two'] = ($data['cat_two'] / 20) * 100;
                        $data['final_exam'] = ($data['final_exam'] / 60) * 100;

                        return $data;
                    })
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['cat_one'] = ($data['cat_one'] / 100) * 20;
                        $data['cat_two'] = ($data['cat_two'] / 100) * 20;
                        $data['total_cw'] = $data['cat_one'] + $data['cat_two'];
                        $data['final_exam'] = ($data['final_exam'] / 100) * 60;
                        $data['total_mark'] = $data['total_cw'] + $data['final_exam'];

                        if ($data['total_mark'] >= 80) {
                            $data['grade_point'] = 5;
                            $data['letter_grade'] = 'A';
                        } elseif ($data['total_mark'] >= 75) {
                            $data['grade_point'] = 4.5;
                            $data['letter_grade'] = 'B+';
                        } elseif ($data['total_mark'] >= 70) {
                            $data['grade_point'] = 4;
                            $data['letter_grade'] = 'B';
                        } elseif ($data['total_mark'] >= 65) {
                            $data['grade_point'] = 3.5;
                            $data['letter_grade'] = 'C+';
                        } elseif ($data['total_mark'] >= 60) {
                            $data['grade_point'] = 3;
                            $data['letter_grade'] = 'C';
                        } elseif ($data['total_mark'] >= 55) {
                            $data['grade_point'] = 2.5;
                            $data['letter_grade'] = 'D+';
                        } elseif ($data['total_mark'] >= 50) {
                            $data['grade_point'] = 2;
                            $data['letter_grade'] = 'D';
                        } else {
                            $data['grade_point'] = 0;
                            $data['letter_grade'] = 'F';
                        }
                        return $data;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

}
