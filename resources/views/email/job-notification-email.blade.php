<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Notification Email</title>
</head>
<body>
    <h1>Hi, {{  $mailData['employer']->firstName }}!</h1>

    <p>A Freelancer is interested to be a part of one of your projects.</p>
    
    <p>Project Title: {{ $mailData['job']->title }}</p>

    <p>Freelancer Details:</p>

    <p>First Name: {{ $mailData['user']->firstName }}</p>
    <p>Middle Name: {{ $mailData['user']->midName }}</p>
    <p>Last Name: {{ $mailData['user']->lastName }}</p>
    <p>Email: {{ $mailData['user']->email }}</p>
    <p>Contact: {{ $mailData['user']->mobile }}</p>
</body>
</html>