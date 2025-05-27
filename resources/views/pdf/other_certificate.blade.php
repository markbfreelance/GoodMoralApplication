<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Certificate</title>
  <style>
    body {
      font-family: 'Times New Roman', serif;
      margin: 50px;
      position: relative;
    }

    header,
    footer {
      text-align: center;
    }

    header img {
      height: 80px;
    }

    .school-info {
      font-size: 12px;
      line-height: 1.4;
    }

    .line {
      border-top: 2px solid #8dc63f;
      margin: 10px 0;
    }

    .certificate-title {
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      letter-spacing: 4px;
      margin-top: 30px;
    }

    .content {
      margin-top: 40px;
      font-size: 14px;
      line-height: 1.8;
    }

    .content strong {
      font-weight: bold;
    }

    .signature {
      margin-top: 60px;
    }

    .signature strong {
      display: block;
      margin-bottom: 2px;
    }

    .footer-note {
      font-size: 10px;
      position: absolute;
      bottom: 60px;
      left: 50px;
    }

    footer {
      position: absolute;
      bottom: 20px;
      left: 0;
      right: 0;
      text-align: center;
    }

    footer img {
      height: 30px;
      margin: 0 10px;
    }

    footer .footer-line {
      border-top: 3px solid #8dc63f;
      margin-bottom: 5px;
    }

    footer .footer-slogan {
      font-size: 10px;
      color: #666;
      font-style: italic;
    }
  </style>
</head>

<body>
  <header>
    <img src="path/to/spup-logo.png" alt="SPUP Logo">
    <div class="school-info">
      <strong>St. Paul University Philippines</strong><br>
      Tuguegarao City, Cagayan 3500<br>
      Tel: 396-1987-1994 | Fax: 078-844-4356<br>
      www.spup.edu.ph<br>
      <strong>OFFICE OF STUDENT AFFAIRS</strong>
    </div>
    <div class="line"></div>
  </header>

  <div class="certificate-title">CERTIFICATION</div>

  <div class="content">
    <p><strong>TO WHOM IT MAY CONCERN:</strong></p>

    <p>This is to certify that <strong>{{ $application->fullname}}</strong> is a graduate of @if($application->department == 'SNAHS')
      <strong>SCHOOL OF NURSING AND ALLIED HEALTH SCIENCES</strong>
      @elseif($application->department === 'SITE')
      <strong>SCHOOL OF INFORMATION TECHNOLOGY AND ENGINEERING</strong>
      @elseif($application->department === 'SASTE')
      <strong>SCHOOL OF ARTS, SCIENCES AND TEACHER EDUCATION</strong>
      @elseif($application->department === 'SBAHM')
      <strong>SCHOOL OF BUSINESS, ACCOUNTANCY AND HOSPITALITY MANAGEMENT</strong>
      @else
      <strong>[Unknown Department]</strong>
      @endif under the program <strong>{{ $studentDetails->year_level }}</strong> in <strong>{{ $studentDetails1->graduation_date }}</strong>.
    </p>

    <p>This certification is issued on <strong>{{ now()->format('jS \\of F Y') }}</strong> in connection with the application for <strong>{{ $application->reason }}</strong>.</p>

    <p>Any courtesy extended will be highly appreciated.</p>

    <div class="signature">
      <strong>RUCEL J.D. PUGEDA, MIT</strong>
      Head, Student Affairs
    </div>
  </div>

  <div class="footer-note">Not valid without University Dry Seal</div>

  <footer>
    <div class="footer-line"></div>
    <div>
      <img src="path/to/logo1.png" alt="Logo 1">
      <img src="path/to/logo2.png" alt="Logo 2">
      <img src="path/to/logo3.png" alt="Logo 3">
      <img src="path/to/logo4.png" alt="Logo 4">
    </div>
    <div class="footer-slogan">MAKING A DIFFERENCE GLOBALLY</div>
  </footer>
</body>

</html>