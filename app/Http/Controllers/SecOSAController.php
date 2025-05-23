<?php

namespace App\Http\Controllers;

use App\Models\ViolationNotif;
use App\Models\GoodMoralApplication;
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
use Illuminate\Support\Str;

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
      // 1. Find the application
      $application = SecOSAApplication::findOrFail($id);
      $studentDetails = StudentRegistration::where('student_id', $application->student_id)->first();
      $studentDetails1 = GoodMoralApplication::where('reference_number', $application->reference_number)->first();
      // 2. Update application status
      $application->status = 'approved';
      $application->save();

      // 3. Get current user
      $sec_osa = Auth::user();

      // 4. Prepare data for the PDF
      $data = [
        'title' => 'Application Approved',
        'application' => $application,
        'approved_by' => $sec_osa->fullname,
        'studentDetails' => $studentDetails,
        'studentDetails1' => $studentDetails1,
      ];

      // 5. Generate PDF
      $pdf = Pdf::loadView('pdf.my_pdf_view', $data);
      Log::info('PDF generated successfully.');

      // 6. Ensure directory exists
      Storage::makeDirectory('public/pdfs');

      // 7. Save the file
      $filename = "application_{$id}.pdf";
      $relativePath = "public/pdfs/{$filename}";
      $saved = Storage::put($relativePath, $pdf->output());

      if ($saved) {
        $fullPath = Storage::path($relativePath);
        Log::info("PDF saved to: " . $fullPath);

        if (file_exists($fullPath)) {
          return response()->download($fullPath);
        } else {
          Log::error("File not found at path: $fullPath");
          return back()->withErrors("PDF saved but not found.");
        }
      } else {
        Log::error("PDF could not be saved.");
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

  public function major()
  {
    // Fetch student violations with status 0 and type 'minor', then paginate
    $students = StudentViolation::where('status', 0)
      ->where('offense_type', 'major')
      ->paginate(10);

    return view('sec_osa.major', compact('students'));
  }

  public function minor()
  {
    // Fetch student violations with status 0 and type 'minor', then paginate
    $students = StudentViolation::where('status', 0)
      ->where('offense_type', 'minor')
      ->paginate(10);

    return view('sec_osa.minor', compact('students'));
  }
  public function uploadDocument(Request $request, $id)
  {
    $request->validate([
      'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $violation = StudentViolation::findOrFail($id);

    $path = $request->file('document')->store('violations_documents', 'public');

    $date = date('Ymd');

    // Generate unique case number with a retry loop
    do {
      $unique = strtoupper(Str::random(6));  // 6 random uppercase letters/numbers
      $caseNumber = "CASE-{$date}-{$unique}";
      $exists = StudentViolation::where('ref_num', $caseNumber)->exists();
    } while ($exists);

    $violation->document_path = $path;
    $violation->ref_num = $caseNumber;
    $violation->status = "1";

    $violation->save();

    ViolationNotif::create([
      'ref_num' => $caseNumber,
      'student_id' => $violation->student_id,
      'status' => 0,  // initial status
      'notif' => "Uploaded the proceedings with case number: $caseNumber",
    ]);

    return back()->with('success', "Document uploaded successfully! Case No: {$caseNumber}");
  }

  public function search(Request $request)
  {
    $query = StudentViolation::query();

    if ($request->filled('first_name')) {
      $query->where('first_name', 'like', '%' . $request->first_name . '%');
    }

    if ($request->filled('last_name')) {
      $query->where('last_name', 'like', '%' . $request->last_name . '%');
    }

    if ($request->filled('student_id')) {
      $query->where('student_id', 'like', '%' . $request->student_id . '%');
    }

    // Add filters for 'status' and 'notif'
    $query->where('status', '0')->where('offense_type', 'major');

    $students = $query->paginate(10);

    return view('sec_osa.major', compact('students'));
  }
}
