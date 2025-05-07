<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Contact Us Message</title>
</head>

<body>
    <h1>Contact Us Message</h1>
    <p><strong>From:</strong> {{ $form['email'] }}</p>
    <p><strong>Phone:</strong> {{ $form['phone'] }}</p>
    <p><strong>Subject:</strong> {{ $form['subject'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $form['message'] }}</p>
</body>

</html>
