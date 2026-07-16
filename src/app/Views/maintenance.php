<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Site Under Maintenance</title>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #111827;
            color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container { text-align: center; padding: 2rem; }
        .icon {
            font-size: 5rem;
            color: #84cc16;
            margin-bottom: 1rem;
            animation: spin 3s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        h1 { font-size: 2.5rem; font-weight: 700; margin-top: 1rem; }
        p { color: #9ca3af; margin-top: 0.75rem; max-width: 28rem; margin-left: auto; margin-right: auto; line-height: 1.6; }
        .btn {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.75rem 2rem;
            background: #84cc16;
            color: #111827;
            font-weight: 600;
            border-radius: 9999px;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn:hover { background: #a3e635; }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">&#128295;</div>
        <h1>Under Maintenance</h1>
        <p>We're currently performing scheduled maintenance. We'll be back shortly. Thank you for your patience.</p>
        <a href="/" class="btn">Try Again</a>
    </div>
</body>
</html>
