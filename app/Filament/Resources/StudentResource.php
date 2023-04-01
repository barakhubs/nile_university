<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Filament\Resources\StudentResource\RelationManagers\ResultsRelationManager;
use App\Models\Program;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->unique(),
                TextInput::make('registration_number')
                    ->required()
                    ->unique(),
                TextInput::make('email')
                    ->nullable()
                    ->type('email'),
                Select::make('program_id')
                    ->options(
                        Program::get()->pluck('title', 'id')->toArray()
                    )
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('registration_number')
                    ->searchable(),
                TextColumn::make('email'),
                TextColumn::make('program.title')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('program_id')
                    ->label('Filter by program')
                    ->relationship('program', 'title')
                    ->searchable(),
            ])
            ->headerActions([
                Action::make('export_to_pdf')->button()->url(route('all-students.results.print'))
            ])
            ->actions([
                Action::make('results')->button()->url(fn (Student $record): string => static::getUrl('results', ['record' => $record])),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->slideOver(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('name')->heading('Student Name'),
                        Column::make('registration_number')->heading('Reg. Number'),
                        Column::make('program.title')->heading('Program'),
                    ]),
                ])
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
            'results' => Pages\ViewStudentResult::route('/{record}/results'),
        ];
    }


}
