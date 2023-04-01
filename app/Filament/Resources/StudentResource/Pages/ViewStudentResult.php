<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\Course;
use App\Models\Result;
use App\Models\Student;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Resources\Pages\ViewRecord;

class ViewStudentResult extends ViewRecord
{
    protected static string $resource = StudentResource::class;
    protected static string $view = 'filament.pages.result';
    protected static ?string $title = 'Student Results';


    public function mount($record): void
    {
        static::authorizeResourceAccess();

        $this->record = $this->resolveRecord($record);

        abort_unless(static::getResource()::canView($this->getRecord()), 403);

        $this->fillForm();
    }

    protected function getViewData(): array
    {

        return [
            'student' => $this->record,
            'results' => Result::where('student_id', $this->record->id)->get(),
        ];
    }
}
