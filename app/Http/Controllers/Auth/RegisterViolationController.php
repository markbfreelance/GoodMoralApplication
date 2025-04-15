<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Violation;
use App\Models\User;
use App\Models\StudentRegistration;
use App\Models\RoleAccount;
use App\Models\StudentViolation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterViolationController extends Controller
{
  /**
   * Display the registration view.
   */
  public function create(): View
  {
    return view('auth.PsgOfficer.PsgAddViolation');
  }

  /**
   * Handle an incoming registration request.
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $currentUserId = Auth::id();

    $currentUser = RoleAccount::find($currentUserId);
    $userName = $currentUser->fullname;
    $uniqueID = $currentUser->student_id;

    $request->validate([
      'first_name' => ['required', 'string', 'max:255'],
      'last_name' => ['required', 'string', 'max:255'],
      'student_id' => ['required', 'string', 'max:20'],
      'violation' => ['required', 'string',  'in:Haircut/punky hair,Dyed hair,Unprescribed undergarment,Unprescribed shoes (Male/Female),Long/short skirt (female),
      Being noisy along corridors,Not wearing of ID properly,Earring (male)/tounge ring (male/female),Wearing of cap inside the campus,Others'],
      'others' => ['nullable', 'string', 'max:255'],
    ]);
    $finalViolation = $request->violation;
    if (!empty($request->others)) {
      $finalViolation .= ' - ' . $request->others;
    }
    $user = StudentViolation::create([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'violation' => $finalViolation,
      'student_id' => $request->student_id,
      'added_by' => $userName,
      'status' => 'Pending',
      'offense_type' => 'minor',
      'unique_id' => $uniqueID,
    ]);
    
    event(new Registered($user));
    Auth::login($user);
    return redirect()->route('PsgOfficer.PsgAddViolation')->with('success', 'Violator Added Successfully!');
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

    $students = $query->paginate(10); // Get paginated results

    return view('PsgOfficer.Violator', compact('students'));
  }
  public function violator()
  {
      // Fetch all student violations and paginate results
      $students = StudentViolation::paginate(10);
  
      // Return the view instead of redirecting
      return view('PsgOfficer.Violator', compact('students'));
  }
  public function ViolatorDashboard()
  {
    $violations = Violation::get();
    return view('PsgOfficer.PsgAddViolation', compact('violations'));
  }
  
}
