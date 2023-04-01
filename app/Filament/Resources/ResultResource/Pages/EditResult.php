<?php

namespace App\Filament\Resources\ResultResource\Pages;

use App\Filament\Resources\ResultResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;


class EditResult extends EditRecord
{
    protected static string $resource = ResultResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
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
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['cat_one'] = ($data['cat_one'] / 20) * 100;
        $data['cat_two'] = ($data['cat_two'] / 20) * 100;
        $data['final_exam'] = ($data['final_exam'] / 60) * 100;

        return $data;
    }
}
