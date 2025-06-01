<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
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

    .header,
    .footer {
      text-align: center;
    }

    .header-content {
      display: flex;
      align-items: flex-start;
      gap: 15px;
      max-width: 600px;
      margin: 0 auto;
    }

    .header-content img {
      width: 60px;
      height: auto;
      display: block;
    }

    .university-info {
      text-align: center;
      font-size: 14px;
      line-height: 1.3;
      margin: 0;
      padding: 0;
    }

    .two-tone-line {
      width: 1000px;
      height: 6px;
      margin: 10px -100px;
      background-color: rgb(255, 217, 0);
      position: relative;
      overflow: hidden;
    }

    .two-tone-line::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 100%;
      height: 50%;
      background-color: rgb(149, 255, 0);
    }

    .content {
      margin-top: 50px;
    }

    .signature {
      margin-top: 80px;
      text-align: left;
    }

    .note {
      margin-top: 50px;
      font-style: italic;
    }

    .footer-logos {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 30px;
      flex-wrap: wrap;
    }

    .footer-logos img {
      height: 40px;
      margin: 0 10px;
    }

    .tagline {
      font-size: 12px;
      color: #666;
      margin-top: 5px;
    }
  </style>
</head>

<body>
  @php
    $logo = base64_encode(file_get_contents(public_path('images/logo/logo.png')));
    $log1 = base64_encode(file_get_contents(public_path('images/logo/log1.png')));
    $log2 = base64_encode(file_get_contents(public_path('images/logo/log2.png')));
    $log3 = base64_encode(file_get_contents(public_path('images/logo/log3.png')));
    $log4 = base64_encode(file_get_contents(public_path('images/logo/log4.png')));
    $log5 = base64_encode(file_get_contents(public_path('images/logo/log5.png')));

    $programs = [
      'BAELS' => 'Bachelor of Arts in English Language Studies',
      'BS Psych' => 'Bachelor of Science in Psychology',
      'BS Bio' => 'Bachelor of Science in Biology',
      'BSSW' => 'Bachelor of Science in Social Work',
      'BSPA' => 'Bachelor of Science in Public Administration',
      'BS Bio MB' => 'Bachelor of Science in Biology Major in Microbiology',
      'BSEd' => 'Bachelor of Secondary Education',
      'BEEd' => 'Bachelor of Elementary Education',
      'BPEd' => 'Bachelor of Physical Education',

      'BSA' => 'Bachelor of Science in Accountancy',
      'BSE' => 'Bachelor of Science in Entrepreneurship',
      'BSBAMM' => 'Bachelor of Science in Business Administration major in Marketing Management',
      'BSBA MFM' => 'Bachelor of Science in Business Administration major in Financial Management',
      'BSBA MOP' => 'Bachelor of Science in Business Administration major in Operations Management',
      'BSMA' => 'Bachelor of Science in Management Accounting',
      'BSHM' => 'Bachelor of Science in Hospitality Management',
      'BSTM' => 'Bachelor of Science in Tourism Management',
      'BSPDMI' => 'Bachelor of Science in Product Design and Marketing Innovation',

      'BSIT' => 'Bachelor of Science in Information Technology',
      'BLIS' => 'Bachelor of Library and Information Science',
      'BSCE' => 'Bachelor of Science in Civil Engineering',
      'BS ENSE' => 'Bachelor of Science in Environmental and Sanitary Engineering',
      'BS CpE' => 'Bachelor of Science in Computer Engineering',
    ];

    $programCode = $studentDetails->year_level ?? null;
  @endphp

  <!-- HEADER -->
  <div class="header">
    <div class="header-content">
      <img src="data:image/png;base64,{{ $logo }}" alt="University Logo" />
      <div class="university-info">
        <strong>St. Paul University Philippines</strong><br />
        Tuguegarao City, Cagayan 3500<br />
        Tel: 396-1987-1994 Fax: 078-8464305<br />
        <a href="http://www.spup.edu.ph">www.spup.edu.ph</a>
      </div>
    </div>

    <h3 style="margin-top: 20px;">OFFICE OF STUDENT AFFAIRS</h3>
    <div class="two-tone-line"></div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="content">
    <h2 class="center">C E R T I F I C A T I O N</h2>

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
      under the program 
      <strong>
        @if($programCode && isset($programs[$programCode]))
          {{ $programs[$programCode] }}
        @else
          [Unknown Program]
        @endif
      </strong> for {{ $studentDetails1->last_semester_sy }}.
      During the period of stay at the University, no disciplinary sanctions were recorded. The student is recognized to be of good moral character.
    </p>

    <p>
      This certification is issued on <strong>{{ now()->format('jS \\of F Y') }}</strong> in connection with {{ $application->reason }}.
    </p>

    <p>Any courtesy extended will be highly appreciated.</p>

    <div class="signature">
      <strong>RUCELJ D. PUGEDA, MIT</strong><br />
      Head, Student Affairs
    </div> <br><br>
    <div class="note">Not valid without University Dry Seal.</div>
    <br>
  </div>

  <!-- FOOTER -->
  <div class="footer">
    <div class="two-tone-line"></div>
    <div class="footer-logos">
      <img src="data:image/png;base64,{{ $log1 }}" alt="Logo 1" />
      <img src="data:image/png;base64,{{ $log2 }}" alt="Logo 2" />
      <img src="data:image/png;base64,{{ $log3 }}" alt="Logo 3" />
      <img src="data:image/png;base64,{{ $log4 }}" alt="Logo 4" style="margin-right: 95px;" />
      <img src="data:image/png;base64,{{ $log5 }}" alt="Logo 5" />
    </div>
  </div>
</body>

</html>
