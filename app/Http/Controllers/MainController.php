<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use Dompdf\FontMetrics;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf;


class MainController extends Controller
{
    public function sendMail($student)
    {
        $student = Student::find($student);
        $data = [
            'email' => 'markbrightbaraka@gmail.com',
            'name' => $student->name,
            'subject' => 'Your semester results',
            'body' => "Hello " . $student->name . ", attached is a pdf file for your results for this semester \n Thanks",
        ];

        // pdf generate
        $results = Result::where('student_id', $student->id)->get();

        $results_data = [
            'student' => $student,
            'results' => $results,
        ];

        $pdf = Pdf::loadView('pdf.result', $results_data);

        // Set options to enable embedded PHP
        $options = new Options();
        $options->set('isPhpEnabled', 'true');

        // Instantiate canvas instance
        $canvas = $pdf->getCanvas();

        // Instantiate font metrics class
        $fontMetrics = new FontMetrics($canvas, $options);

        // Get height and width of page
        $w = $canvas->get_width();
        $h = $canvas->get_height();

        // Get font family file
        $font = $fontMetrics->getFont('times');

        // Specify watermark text
        $text = "Nile University";

        // Get height and width of text
        $txtHeight = $fontMetrics->getFontHeight($font, 55);
        $textWidth = $fontMetrics->getTextWidth($text, $font, 55);

        // Set text opacity
        $canvas->set_opacity(.09);

        // Specify horizontal and vertical position
        $x = (($w - $textWidth) / 2);
        $y = (($h - $txtHeight) / 2);

        // Writes text at the specified x and y coordinates
        $canvas->text($x, $y, $text, $font, 75, ['','',''],0,0,-35);

        Mail::raw($data['body'], function ($message) use ($data, $pdf, ) {
            $message->to($data['email'], $data['name'])
                ->subject($data['subject'])
                ->attachData($pdf->output(), $data['name'].'.pdf');
        });

        Notification::make()
            ->title('Email sent successfully')
            ->icon('heroicon-o-document-text')
            ->send();
        return redirect()->back();
    }

    function generatePdf($student)
    {
        $student = Student::find($student);
        $results = Result::where('student_id', $student->id)->get();

        $data = [
            'student' => $student,
            'results' => $results,
        ];

        $pdf = Pdf::loadView('pdf.result', $data);

        // Set options to enable embedded PHP
        $options = new Options();
        $options->set('isPhpEnabled', 'true');

        // Instantiate canvas instance
        $canvas = $pdf->getCanvas();

        // Instantiate font metrics class
        $fontMetrics = new FontMetrics($canvas, $options);

        // Get height and width of page
        $w = $canvas->get_width();
        $h = $canvas->get_height();

        // Get font family file
        $font = $fontMetrics->getFont('times');

        // Specify watermark text
        $text = "Nile University";

        // Get height and width of text
        $txtHeight = $fontMetrics->getFontHeight($font, 55);
        $textWidth = $fontMetrics->getTextWidth($text, $font, 55);

        // Set text opacity
        $canvas->set_opacity(.09);

        // Specify horizontal and vertical position
        $x = (($w - $textWidth) / 2);
        $y = (($h - $txtHeight) / 2);

        // Writes text at the specified x and y coordinates
        $canvas->text($x, $y, $text, $font, 75, ['','',''],0,0,-35);

        return $pdf->download($student->name.'.pdf');
    }

    public function studentPdf() {

        $students = Student::all();

        $data = [
            'students' => $students,
        ];

        $pdf = Pdf::loadView('pdf.students', $data);

        // Set options to enable embedded PHP
        $options = new Options();
        $options->set('isPhpEnabled', 'true');

        // Instantiate canvas instance
        $canvas = $pdf->getCanvas();

        // Instantiate font metrics class
        $fontMetrics = new FontMetrics($canvas, $options);

        // Get height and width of page
        $w = $canvas->get_width();
        $h = $canvas->get_height();

        // Get font family file
        $font = $fontMetrics->getFont('times');

        // Specify watermark text
        $text = "Nile University";

        // Get height and width of text
        $txtHeight = $fontMetrics->getFontHeight($font, 55);
        $textWidth = $fontMetrics->getTextWidth($text, $font, 55);

        // Set text opacity
        $canvas->set_opacity(.09);

        // Specify horizontal and vertical position
        $x = (($w - $textWidth) / 2);
        $y = (($h - $txtHeight) / 2);

        // Writes text at the specified x and y coordinates
        $canvas->text($x, $y, $text, $font, 75, ['','',''],0,0,-35);

        return $pdf->download('students_results.pdf');
    }
}
