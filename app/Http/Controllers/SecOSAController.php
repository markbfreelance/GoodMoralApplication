<?php

namespace App\Http\Controllers;

use App\Models\SecOSAApplication;
use App\Models\NotifArchive;
use App\Models\RoleAccount;
use App\Models\StudentRegistration;
use App\Traits\RoleCheck;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentViolation;
use App\Models\Violation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request; // Add this line
use Illuminate\Support\Facades\Log;

class SecOSAController extends Controller
{

  use RoleCheck;

  public function __construct()
  {
    // Apply role check for all methods in this controller
    $this->checkRole(['sec_osa']);
  }
  public function dashboard()
  {
    //Applicants per department
    $site = SecOSAApplication::where('department', 'SITE')->count();
    $saste = SecOSAApplication::where('department', 'SASTE')->count();
    $sbahm = SecOSAApplication::where('department', 'SBAHM')->count();
    $snahs = SecOSAApplication::where('department', 'SNAHS')->count();

    //For Pie Chart stats
    $minorpending = StudentViolation::where('status', 'pending')->where('offense_type', 'minor')->count();
    $minorcomplied = StudentViolation::where('status', 'complied')->where('offense_type', 'minor')->count();
    $majorpending = StudentViolation::where('status', 'pending')->where('offense_type', 'major')->count();
    $majorcomplied = StudentViolation::where('status', 'complied')->where('offense_type', 'major')->count();
    //Pageinate
    $violationpage = Violation::paginate(10);

    $applications = SecOSAApplication::where('status', 'pending')->get();
    return view('sec_osa.dashboard', compact('applications', 'site', 'sbahm', 'saste', 'snahs', 'minorpending', 'minorcomplied', 'majorpending', 'majorcomplied', 'violationpage'));
  }

  public function application()
  {
    $applications = SecOSAApplication::get();

    return view('sec_osa.Application', compact('applications'));
  }
  public function approve(Request $request, $id)
  {
    try {
      $application = SecOSAApplication::findOrFail($id);
      $studentDetails = StudentRegistration::where('student_id', $application->student_id)->get();

      $application->status = 'approved';
      $application->save();

      $sec_osa = Auth::user();

      NotifArchive::create([
        'number_of_copies' => $application->number_of_copies,
        'reference_number' => $application->reference_number,
        'fullname' => $application->fullname,
        'reason' => $application->reason,
        'student_id' => $application->student_id,
        'department' =>  $application->department,
        'course_completed' =>  $application->course_completed,
        'graduation_date' => $application->graduation_date,
        'application_status' => null,
        'is_undergraduate' => $application->is_undergraduate,
        'last_course_year_level' => $application->last_course_year_level,
        'last_semester_sy' => $application->last_semester_sy,
        'status' => '4',
      ]);

      $data = [
        'title' => 'Application Approved',
        'application' => $application,
        'approved_by' => $sec_osa->fullname,
        'studentDetails' => $studentDetails,
      ];

      $pdf = Pdf::loadView('pdf.my_pdf_view', $data);
      Storage::makeDirectory('public/pdfs');
      $filename = "application_{$application->reference_number}.pdf";
      $relativePath = "public/pdfs/{$filename}";
      $saved = Storage::put($relativePath, $pdf->output());

      if ($saved) {
        $url = asset("storage/pdfs/{$filename}");
        // 🔁 Redirect back with the PDF URL in session
        return redirect()->back()->with('pdf_url', $url);
      } else {
        return back()->withErrors("PDF could not be saved.");
      }
    } catch (\Exception $e) {
      Log::error("Approve Error: " . $e->getMessage());
      return back()->withErrors("An error occurred: " . $e->getMessage());
    }
  }


  public function reject($id)
  {
    $application = SecOSAApplication::findOrFail($id);
    $application->status = 'rejected';
    $application->save();

    return redirect()->route('sec_osa.dashboard')->with('status', 'Application rejected!');
  }
}
