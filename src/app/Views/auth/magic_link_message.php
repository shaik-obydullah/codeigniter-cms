<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Check Your Email - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700 text-center">
            <div class="w-16 h-16 bg-lime-500/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-envelope-open-text text-2xl text-lime-400"></i>
            </div>
            <h1 class="text-2xl font-bold text-white mb-2">Check Your Email</h1>
            <p class="text-gray-400 text-sm">We've sent a magic login link to your email. Please check your inbox and click the link to sign in.</p>
            <p class="text-gray-500 text-xs mt-4">Didn't receive the email? <a href="<?= route_to('magic-link') ?>" class="text-lime-500 hover:text-lime-400 transition">Resend</a></p>
            <p class="mt-6"><a href="<?= route_to('login') ?>" class="text-lime-500 hover:text-lime-400 transition text-sm font-medium">Back to Login</a></p>
        </div>
    </div>

</body>
</html>
