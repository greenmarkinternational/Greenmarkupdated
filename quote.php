<?php
require 'conn.php';
include 'navbar.php';

// If form is submitted
if (isset($_POST['submit'])) {

  // reCAPTCHA validation
  $recaptcha_secret = '6LfQsyorAAAAAPjL2SvAB3OIrwxiwXtzq51rfiKy'; // Replace with your reCAPTCHA secret key
  $recaptcha_response = $_POST['g-recaptcha-response'];

  // Verify reCAPTCHA response
  $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
  $response = json_decode($verify);

  if ($response->success) {

    // Get form values and sanitize them
    $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $company_name = mysqli_real_escape_string($conn, trim($_POST['company_name']));
    $message = mysqli_real_escape_string($conn, trim($_POST['message']));

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message) || empty($phone) || empty($company_name)) {
      echo "Please fill all required fields.";
    } else {
      // Prepare SQL query using prepared statement
      $query = "INSERT INTO quotes (first_name, last_name, phone, email, company_name, message) 
                      VALUES (?, ?, ?, ?, ?, ?)";

      if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, 'ssssss', $first_name, $last_name, $phone, $email, $company_name, $message);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
          echo "Your quote request has been submitted successfully!";
        } else {
          echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
      } else {
        echo "Error preparing statement.";
      }
    }
  } else {
    echo "Captcha verification failed. Please try again.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quote - Greenmark</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.min.css" />


  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      overflow-x: hidden;
    }

    .container-fluid {
      font-family: "Montserrat", Sans-serif;
      font-size: 20px;
      font-weight: 700;
      text-transform: uppercase;
      font-style: normal;
      text-decoration: none;
      line-height: 1.5em;
      letter-spacing: 0px;
      word-spacing: 0em;
    }

    .left-section {
      background: url(assets/images/quotebgimg.jpeg) no-repeat center center;
      background-blend-mode: color;
      background-size: cover;
      background-color: rgba(0, 0, 0, 0.55);
      color: white;
      padding: 60px 30px;
      justify-content: center;
    }

    .right-section {
      background: url(https://img.freepik.com/free-vector/realistic-blue-sky-background_1048-6707.jpg?ga=GA1.1.1855728225.1744243813&semt=ais_hybrid&w=740) no-repeat center center;
      background-size: cover;
      padding: 60px 0px;
      background-color: rgba(0, 0, 0, 0.55);
      color: white;
    }

    .getaquote {
      font-size: 50px;
      font-weight: 700;
    }

    .right-overlayyy{
      margin: 0 40px;
    }

    .form-control:focus {
      box-shadow: none;
      border-color: #0056b3;
    }

    .btn-orange {
      background-color: #ff6f3c;
      color: white;
    }

    .btn-orange:hover {
      background-color: #e85b23;
    }



    .title {
      color: #FFFFFF;
      font-family: "Montserrat", Sans-serif;
      font-size: 23px;
      font-weight: 700;
      text-transform: uppercase;
      font-style: normal;
      text-decoration: none;
      line-height: 1.5em;
      letter-spacing: 3px;
      text-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
    }

    .h1 {
      color: #FFFFFF;
      font-family: "Montserrat", Sans-serif;
      font-size: 55px;
      font-weight: 700;
      text-transform: none;
      font-style: normal;
      text-decoration: none;
      line-height: 1em;
      letter-spacing: 0px;
      text-shadow: 0px 0px 25px rgba(0, 0, 0, 0.5);
      margin: 15px 0;
    }

    .quote-input {
      padding: 10px;
    }

    .icons-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    .icons-inner-container {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .icons-inner-container>img {
      width: 90px;
    }

    @media(max-width:480px) {
      .h1 {
        font-size: 32px;
      }

      .title {
        font-size: 20px;
      }

      .para {
        font-size: 16px;
      }
      .right-overlayyy{
      margin: 0 15px;
    }

    }

    @media(max-width:769px) {
      .icons-container {
        display: grid;
        grid-template-columns: 1fr;
      }

      .h1 {
        font-size: 32px;
      }

      .title {
        font-size: 20px;
      }

      .para {
        font-size: 16px;
      }

      .icons-inner-container {
        justify-content: start;
        display: flex;
        flex-direction: row;
      }

      .icons-inner-container>p {
        font-size: 18px;
      }
    }



    /* Responsive below 1080px */
    @media (max-width: 1080px) and  (min-width:770px) {
      .left-section {
        flex-direction: column;
        text-align: center;
      }

      .h1 {
        font-size: 36px;
      }

      .title {
        font-size: 24px;
      }

      .para {
        font-size: 18px;
        padding: 0 10px;
      }

      .icons-container {
        display: grid;
        /* grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); */
        gap: 5px;
        justify-items: center;
        margin-top: 20px;
      }

      .icons-inner-container {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
      }

      .icons-inner-container>p {
        font-size: 16px;
        margin-top: 4px;
      }
    }

    /* right section */


    @media (max-width: 1400px) {
      form .row {
        display: flex;
        flex-direction: column;
      }

      form .row .col-md-6 {
        width: 100%;
      }

    }
    @media (max-width: 910px) {
  .container-fluid>.row {
    display: flex;
    flex-direction: column;
  }
  .right-section,.left-section{
    width: 100%;
  }
}
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Left Section -->
      <div class="col-md-7 left-section d-flex align-items-center">
        <!-- left-overlay -->
        <div class="w-100" style="text-align: center; width:85%;">
          <h3 class="title">MAINTENANCE OF THE WATER SYSTEM</h3>
          <h1 class="h1"><span style="color: #27ae60;">Septic Tank</span> Cleaning Services</h1>
          <!-- <p class="para">Complete tank pumping and cleaning System inspection and maintenance Drain field restoration</p> -->
          <div class="icons-container">
            <div class="icons-inner-container">
              <img src="assets/images/first section images trusted by leading/img4.png" alt="">
              <p>Complete tank pumping and cleaning</p>
            </div>
            <div class="icons-inner-container">
              <img src="assets/images/first section images trusted by leading/img1.png" alt="">
              <p>System inspection and maintenance</p>
            </div>
            <div class="icons-inner-container">
              <img src="assets/images/first section images trusted by leading/img1.png" alt="">
              <p>Drain field restoration</p>
            </div>
            <div class="icons-inner-container">
              <img src="assets/images/first section images trusted by leading/img1.png" alt="">
              <p>Eco-friendly waste disposal</p>
            </div>
            <div class="icons-inner-container">
              <img src="assets/images/first section images trusted by leading/img1.png" alt="">
              <!-- <p>Controlled Air Incineration</p> -->
            </div>
            <div class="icons-inner-container">
              <img src="assets/images/first section images trusted by leading/img1.png" alt="">
              <!-- <p>Controlled Air Incineration</p> -->
            </div>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="col-md-5 right-section d-flex align-items-center">
        <!-- right-overlay -->
        <div class="w-100 " style="margin: 0 40px;">
          <h2 class="mb-3 getaquote">Get a Quote</h2>
          <p>Learn how Verantis can help you. Get a quote now and breathe easy!</p>
          <form method="post">
  <div class="row">
    <div class="col-md-6 mb-3">
      <input type="text" class="form-control quote-input" name="first_name" placeholder="First name" required>
    </div>
    <div class="col-md-6 mb-3">
      <input type="text" class="form-control quote-input" name="last_name" placeholder="Last name" required>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-3">
      <input type="tel" id="phone" name="phone" class="form-control quote-input" placeholder="Phone number" required>
    </div>
    <div class="col-md-6 mb-3">
      <input type="email" class="form-control quote-input" name="email" placeholder="Email" required>
    </div>
  </div>

  <div class="mb-3">
    <input type="text" class="form-control quote-input" name="company_name" placeholder="Company name" required>
  </div>

  <div class="mb-3">
    <textarea class="form-control quote-input" name="message" rows="4" placeholder="How can we help you?" required></textarea>
  </div>

  <div class="mb-3">
    <div class="g-recaptcha" data-sitekey="6LftwyorAAAAABAKBGkQSJ97MoL6R75PO0J6jRIU"></div>
  </div>

  <button type="submit" name="submit" class="btn btn-orange">Submit</button>
</form>
        </div>
      </div>
    </div>
  </div>

  <!-- reCAPTCHA script -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <?php
  include 'footer.php';
  ?>



<!-- reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


</body>

</html>