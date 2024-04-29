<?php
include 'config.php';

// Function to sanitize form input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Replace with your actual Secret Key stored in a secure environment variable
$secret = RECAPTCHA_SECRET_KEY;

// User response from the reCAPTCHA field
$response = $_POST['g-recaptcha-response'];

// Verify the user response with Google servers
$url = "https://www.google.com/recaptcha/api/siteverify";
$data = array(
    'secret' => $secret,
    'response' => $response
);

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$result = json_decode($response);

// Initialize alert message and type variables
$alert_message = "";
$alert_type = "";

// Check the verification result
if ($result->success) {
    // Verification successful, process the form submission
    // Sanitize form input
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $message = sanitize_input($_POST['message']);

    // Email recipient
    $to = 'will@alnwickwebdesign.co.uk';

    // Email subject
    $subject = 'Form Submission from Website';

    // Email body
    $body = "Name: $name\nEmail: $email\nPhone Number: $phone\nMessage: $message";

    // Send the email with error handling
    if (mail($to, $subject, $body)) {
        $alert_message = "Form submitted successfully! Thank you. We aim to reply within 48 workin hours.";
        $alert_type = "success";
    } else {
        $alert_message = "Error: Unable to send email. Please give us a call instead!";
        $alert_type = "danger";
    }
} else {
    // Verification failed
    $alert_message = "Google reCAPTCHA verification failed. Please try again.";
    $alert_type = "danger";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/heroes.css">
  <link rel="stylesheet" href="css/navbar-fixed.css">
  <link rel="stylesheet" href="css/features.css">
  <link rel="stylesheet" href="css/modal.css">
  <link rel="stylesheet" href="css/portfolio.css">
  <link rel="stylesheet" href="assets/css/style.css">
  
    <!-- JavaScript for redirect -->
    <!-- <script>
        setTimeout(function() {
            window.location.href = 'index.html';
        }, 5000);
    </script> -->
</head>
<body>

<section class="hero d-flex align-items-center hero-section pb-2">
    <div class="container hero-bg text-center animated-element" data-aos="fade-up" data-aos-duration="1000">
      <h1 class="display-5 fw-bold pt-1 pb-1">Form Submission</h1>
      <div class="mx-auto alert alert-<?php echo $alert_type; ?>" role="alert">
            <?php echo $alert_message; ?>
        </div>
      <p class="lead mb-2 pb-2">You can also call us on: 07488315367</p>
      <div class="text-center">
        <a href="index.html" class="btn-get-started">Home</a>
      </div>
    </div>
  </section>



</body>
</html>
