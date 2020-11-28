<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedbackForm;
use PDF;

class ExportController extends Controller
{
    public function create(){
        return view('admin.export.create')->with([
            'feedback_forms' => FeedbackForm::pluck('feedback_name','id')
        ]);
    }

    public function generate(Request $request){
        $this->authorize('viewReport',FeedbackForm::class);
        $feedbackForm = FeedbackForm::findOrFail($request->feedback_name);
        FeedbackForm::hasReport($request->feedback_name);
        $report = FeedbackForm::getData($request->feedback_name,0);
        if($report == null)
            return redirect()->route('admin.feedback-forms.report',[$id,0])->withErrors('No students above '.$attendence.'% attendence.');
        $pdf = PDF::loadView('admin.feedback-forms.rawreport', $report); 
        return $pdf->download($feedbackForm->feedback_name.'.pdf');
    }
}
