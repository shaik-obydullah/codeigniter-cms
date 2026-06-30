<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-lime-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-halved text-2xl text-gray-900"></i>
                </div>
                <h1 class="text-2xl font-bold text-white">Forgot Password</h1>
                <p class="text-gray-400 text-sm mt-1">Enter your email to receive a magic login link</p>
            </div>

            <?php if (session('error')): ?>
                <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
            <?php endif; ?>
            <?php if (session('message')): ?>
                <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
            <?php endif; ?>

            <form action="<?= site_url('magic-link') ?>" method="post" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" value="<?= old('email') ?>" placeholder="you@example.com" required
                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-lime-500 text-gray-900 font-semibold py-2.5 rounded-lg hover:bg-lime-400 transition shadow-lg shadow-lime-500/25">
                    <i class="fas fa-paper-plane mr-2"></i> Send Magic Link
                </button>
            </form>

            <p class="text-center text-gray-500 text-sm mt-6">
                <a href="<?= site_url('login') ?>" class="text-lime-500 hover:text-lime-400 transition font-medium">Back to Login</a>
            </p>
        </div>

        <p class="text-center text-gray-500 text-xs mt-6">&copy; <?= date('Y') ?> Shaik Obydullah. All rights reserved.</p>
    </div>

</body>
</html>
