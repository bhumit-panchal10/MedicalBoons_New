<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            padding-top: 100px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        h1 {
            font-size: 100px;
            margin-bottom: 10px;
            color: #dc3545;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #6c757d;
        }

        a {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>Oops! The page you are looking for does not exist or has been moved.</p>
        <a href="{{ url('/') }}">Go Back Home</a>
    </div>
</body>
</html>
