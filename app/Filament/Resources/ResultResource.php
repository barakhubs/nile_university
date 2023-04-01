<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Filament\Resources\ResultResource\Pages\EditResult;
use App\Filament\Resources\ResultResource\RelationManagers;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Result;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;
use Closure;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;


class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('program_id')
                    ->label('Select Program')
                    ->options(
                        Program::all()->pluck('title', 'id')->toArray()
                    )
                    ->reactive()
                    ->required()
                    ->preload()
                    ->dehydrated(false)
                    ->searchable()
                    ->hiddenOn(EditResult::class)
                    ->afterStateUpdated(fn (callable $set) => $set('course_id', null)),

                Select::make('course_id')
                    ->label('Select Course')
                    ->required()
                    ->searchable()
                    ->disabledOn(EditResult::class)
                    ->options(function (callable $get) {
                        $program = Program::find($get('program_id'));

                        if(!$program) {
                            return Course::all()->pluck('title', 'id');
                        }

                        return $program->courses->pluck('title', 'id');
                    }),

                Select::make('student_id')
                    ->required()
                    ->label('Select Student')
                    ->options(
                        function (callable $get) {
                            $program = Program::find($get('program_id'));

                            if($program) {
                                return Student::where('program_id', $program->id)->pluck('name', 'id');
                            }
                            return Student::get()->pluck('name', 'id');

                        })
                        ->searchable()
                        ->disabledOn(EditResult::class)
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
                Tables\Columns\TextColumn::make('course.title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cat_one')->label('CAT 1'),
                Tables\Columns\TextColumn::make('cat_two')->label('CAT 2'),
                Tables\Columns\TextColumn::make('final_exam'),
            ])
            ->filters([
                // SelectFilter::make('result.course.title')
                //     ->label('Filter by faculty')
                //     ->relationship('course', 'title')
                //     ->searchable(),
            ])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('student.name')->heading('Students'),
                        Column::make('course.program.faculty.title')->heading('Faculty'),
                        Column::make('course.program.title')->heading('Program'),
                        Column::make('course.title')->heading('Course'),
                        Column::make('cat_one')->heading('CAT I'),
                        Column::make('cat_two')->heading('CAT II'),
                        Column::make('final_exam')->heading('Final Exam'),
                        Column::make('total_mark')->heading('Total Mark'),
                        Column::make('letter_grade')->heading('Letter Grade'),
                        Column::make('grade_point')->heading('Grade Point'),
                    ]),
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('student.name')->heading('Students'),
                        Column::make('course.program.faculty.title')->heading('Faculty'),
                        Column::make('course.program.title')->heading('Program'),
                        Column::make('course.title')->heading('Course'),
                        Column::make('cat_one')->heading('CAT I'),
                        Column::make('cat_two')->heading('CAT II'),
                        Column::make('final_exam')->heading('Final Exam'),
                        Column::make('total_mark')->heading('Total Mark'),
                        Column::make('letter_grade')->heading('Letter Grade'),
                        Column::make('grade_point')->heading('Grade Point'),
                    ]),
                ])
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
            'index' => Pages\ListResults::route('/'),
            'create' => Pages\CreateResult::route('/create'),
            'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }
}
