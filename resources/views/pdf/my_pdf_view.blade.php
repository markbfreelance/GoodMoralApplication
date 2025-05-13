<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 50px;
            line-height: 1.6;
        }
        .center {
            text-align: center;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin-top: 50px;
        }
        .signature {
            margin-top: 80px;
            text-align: right;
        }
        .note {
            margin-top: 40px;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="header">
    <strong>St. Paul University Philippines</strong><br>
    Tuguegarao City, Cagayan 3500<br>
    Tel: 396-1987-1994 | Fax: 078-8464305<br>
    <a href="http://www.spup.edu.ph">www.spup.edu.ph</a><br><br>

    <h3>OFFICE OF STUDENT AFFAIRS</h3>
</div>

<div class="content">
    <h2 class="center">CERTIFICATION</h2>

    <p>TO WHOM IT MAY CONCERN:</p>

    <p>
        This is to certify that <strong>{{ $application->fullname }}</strong> is a student of the     
    @if($application->department == 'SNAHS')
        <strong>SCHOOL OF NURSING AND ALLIED HEALTH SCIENCES</strong>
    @elseif($application->department === 'SITE')
        <strong>SCHOOL OF INFORMATION TECHNOLOGY AND ENGINEERING</strong>
     @elseif($application->department === 'SASTE')
        <strong>SCHOOL OF ARTS, SCIENCES AND TEACHER EDUCATION</strong>
    @elseif($application->department === 'SBAHM')
        <strong>SCHOOL OF BUSINESS, ACCOUNTANCY AND HOSPITALITY MANAGEMENT</strong>
    @else
        <strong>[Unknown Department]</strong>
    @endif
        under the program <strong>{{ $studentDetails->year_level }}</strong> for {{ $studentDetails1->last_semester_sy }}. During the period of stay at the 
        University, no disciplinary sanctions were recorded. The student is recognized to be of good moral character.
    </p>

    <p>
    This certification is issued on <strong>{{ now()->format('jS \\of F Y') }}</strong> in connection with {{ $application->reason }}.
  </p>

    <p>Any courtesy extended will be highly appreciated.</p>

    <div class="signature">
        <strong>RUCELJ D. PUGEDA, MIT</strong><br>
        Head, Student Affairs
    </div>

    <div class="note">
        Not valid without University Dry Seal.
    </div>
</div>

</body>
</html>
