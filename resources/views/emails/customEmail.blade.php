<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto; /* Center the container vertically */
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        p {
            margin: 20px 0;
            font-size: 16px;
            line-height: 1.6;
            text-align: left;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('assets/images/Frame127.png') }}" alt="Logo">
        <p>From: {{ $email }} </p>
        <p>Name: {{ $first_name }} {{ $last_name }} </p>
        <p>Message: {{ $line }}</p>
    </div>
    <footer>
        <p style="text-align: center;">All Rights Reserved. GiftHub</p>
    </footer>
</body>
</html>
