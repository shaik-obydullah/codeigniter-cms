<?= view('layout/header', ['title' => 'Sign In - Shaik Obydullah']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md mx-auto px-6">
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-white">Welcome Back</h1>
                <p class="text-gray-400 text-sm mt-1">Sign in to your account</p>
            </div>

            <?php if (session('error')): ?>
                <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm"><?= esc(session('error')) ?></div>
            <?php endif; ?>
            <?php if (session('errors')): ?>
                <div class="mb-4 px-4 py-3 bg-red-500/10 border border-red-500/30 rounded-lg text-red-400 text-sm">
                    <?php foreach (session('errors') as $err): ?>
                        <?= esc($err) ?><br>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if (session('message')): ?>
                <div class="mb-4 px-4 py-3 bg-green-500/10 border border-green-500/30 rounded-lg text-green-400 text-sm"><?= esc(session('message')) ?></div>
            <?php endif; ?>

            <form action="<?= route_to('login') ?>" method="post" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" value="<?= old('email', $email ?? '') ?>" placeholder="you@example.com" required
                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" required
                            class="w-full bg-gray-700 border border-gray-600 text-white rounded-lg pl-10 pr-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent placeholder-gray-500" />
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-400 cursor-pointer">
                        <input type="checkbox" name="remember" value="1" checked
                            class="w-4 h-4 rounded bg-gray-700 border-gray-600 text-lime-500 focus:ring-lime-500 focus:ring-offset-0 cursor-pointer" />
                        Remember me
                    </label>
                    <a href="<?= route_to('magic-link') ?>" class="text-lime-500 hover:text-lime-400 transition">Forgot password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-lime-500 text-gray-900 font-semibold py-2.5 rounded-lg hover:bg-lime-400 transition shadow-lg shadow-lime-500/25">
                    <i class="fas fa-right-to-bracket mr-2"></i> Sign In
                </button>
            </form>

            <?php if (setting('Auth.allowRegistration')): ?>
            <p class="text-center text-gray-500 text-sm mt-6">
                Don't have an account? <a href="<?= route_to('register') ?>" class="text-lime-500 hover:text-lime-400 transition font-medium">Create one</a>
            </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
