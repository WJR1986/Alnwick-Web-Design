<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Response</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Set your email address here
    $email_to = "willrichardson182@gmail.com";

    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Create email body
    $email_body = "You have received a contact message from your website.\n\n" .
                 "Name: $name\n" .
                 "Email: $email\n" .
                 "Phone (Optional): $phone\n\n" .
                 "Message:\n" .
                 $message . "\n";

    // Send email
    $headers = "From: $name <$email>\r\n"; // Set sender name and email

    if (mail($email_to, "Contact Form Submission", $email_body, $headers)) {
      $message = "Thank you for your message! We will reply to you shortly. (This message will close in 5 seconds or use the close button)";
      $alert_class = "alert-success";
    } else {
      $message = "An error occurred while sending your message. Please try again later.";
      $alert_class = "alert-danger";
    }

    ?>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="responseModalLabel">Form Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert <?php echo $alert_class; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Show modal on page load
    window.onload = function() {
        $('#responseModal').modal('show');
    };

    // Redirect after 5 seconds or on modal close
    setTimeout(function() {
        window.location.href = "index.html"; // Replace with your index.html URL
    }, 5000); // Redirect after 5 seconds (adjust as needed)
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>
</html>
