<!DOCTYPE html>
<html lang="en" x-data="loginForm()">
<head>
    <meta name="robots" content="noindex, nofollow">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <title>Admin Login</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/assets/images/favicon/android-chrome-512x512.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/images/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest">
    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .lockout-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 100;
            border-radius: 0.75rem;
        }
    </style>
</head>
<body class="bg-gray-900">
    <div x-show="loading" class="loading-overlay">
        <p class="text-white text-xl">Loading...</p>
    </div>
    <div class="flex min-h-screen items-center justify-center">
        <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg relative">
            <!-- Lockout Overlay -->
            <div x-show="isLocked" class="lockout-overlay">
                <svg xmlns="http://www.w3.org /2000/svg" class="h-12 w-12 text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-800 m-2">Account Locked</h3>
                <p class="text-gray-600 m-4" x-text="lockoutMessage"></p>
                <div class="flex items-center space-x-2">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-700 font-medium" x-text="countdown"></span>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-center mb-6 text-gray-900">Admin Login</h2>
            <div x-show="error" x-text="error" class="mb-4 p-3 bg-red-100 text-red-700 rounded"></div>
            <form @submit.prevent="submitForm" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" x-model="formData.user_name" :disabled="isLocked" class="mt-1 w-full px-4 py-2 border rounded-lg text-gray-900 focus:ring focus:ring-lime-500 focus:border-lime-500 disabled:bg-gray-100" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" x-model="formData.password" :disabled="isLocked" class="mt-1 w-full px-4 py-2 border rounded-lg text-gray-900 focus:ring focus:ring-lime-500 focus:border-lime-500 disabled:bg-gray-100" required />
                </div>
                <button type="submit" class="w-full bg-lime-600 hover:bg-lime-700 text-white py-2 rounded-lg font-semibold disabled:bg-gray-400" :disabled="loading || isLocked">
                    <span x-show="!loading">Login</span>
                    <span x-show="loading">Processing...</span>
                </button>
            </form>
        </div>
    </div>
    <script>
        function loginForm() {
            return {
                loading: false,
                error: '',
                isLocked: <?= session()->get('locked') ? 'true' : 'false' ?>,
                lockoutMessage: 'Too many failed attempts. Please try again later.',
                countdown: '5:00',
                countdownInterval: null,
                formData: {
                    user_name: '',
                    password: '',
                    [document.querySelector('input[name="<?= csrf_token() ?>"]').name]:
                        document.querySelector('input[name="<?= csrf_token() ?>"]').value
                },

                init() {
                    if (this.isLocked) {
                        this.startCountdown();
                    }
                },

                startCountdown() {
                    let timeLeft = 300;
                    this.updateCountdownDisplay(timeLeft);
                    this.countdownInterval = setInterval(() => {
                        timeLeft--;
                        this.updateCountdownDisplay(timeLeft);
                        
                        if (timeLeft <= 0) {
                            clearInterval(this.countdownInterval);
                            this.isLocked = false;
                            window.location.reload();
                        }
                    }, 1000);
                },

                updateCountdownDisplay(seconds) {
                    const mins = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    this.countdown = `${mins}:${secs < 10 ? '0' : ''}${secs}`;
                },

                submitForm() {
                    if (this.isLocked) return;
                    
                    this.loading = true;
                    this.error = '';

                    // Get fresh token value before each request
                    const csrfToken = document.querySelector('input[name="<?= csrf_token() ?>"]').value;
                    this.formData[document.querySelector('input[name="<?= csrf_token() ?>"]').name] = csrfToken;

                    fetch('/auth', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then(response => {
                        if (response.status === 403) {
                            this.handleLockout();
                            throw new Error('Account locked due to too many failed attempts.');
                        }
                        
                        if (response.status === 429) {
                            return response.json().then(data => {
                                throw new Error(data.message || 'Too many attempts. Please try again later.');
                            });
                        }
                        
                        if (!response.ok) {
                            throw new Error('Login failed');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.csrf_token) {
                            document.querySelector('input[name="<?= csrf_token() ?>"]').value = data.csrf_token;
                            document.querySelector('meta[name="csrf-token"]').content = data.csrf_token;
                            this.formData[document.querySelector('input[name="<?= csrf_token() ?>"]').name] = data.csrf_token;
                        }

                        if (data.success) {
                            window.location.href = data.redirect || '/dashboard';
                        } else {
                            this.error = data.message || 'Login Failed';
                        }
                    })
                    .catch(error => {
                        this.error = error.message;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
                },

                handleLockout() {
                    this.isLocked = true;
                    this.lockoutMessage = 'Account locked due to too many failed attempts. Please try again later.';
                    this.startCountdown();
                }
            }
        }
    </script>
</body>
</html>