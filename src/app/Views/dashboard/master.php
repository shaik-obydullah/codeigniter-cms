<!DOCTYPE html>
<html lang="en" x-data="dashboard">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <title><?= $title ?></title>
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        .loading-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="bg-gray-100" x-cloak>
    <div class="flex min-h-screen">
        <aside class="w-64 bg-gray-800 shadow-lg flex flex-col">
            <div class="p-5 text-center text-white text-xl font-bold tracking-wide border-b border-gray-700">
                Lime CMS
            </div>
            <nav class="flex-1 mt-4 overflow-y-auto">
                <ul class="space-y-1 px-4">
                    <li>
                        <a href="<?= base_url() ?>dashboard" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/dashboard') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">🏠</span>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>namaz" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/namaz') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">🤲🏻</span>
                            Namaz
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>wallet" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/wallet') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">💳</span>
                            Wallets
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>income" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/income') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">📈</span>
                            Incomes
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>expense" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/expense') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">📉</span>
                            Expenses
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>cashbook" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/cashbook') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">💰</span>
                            Cashbook
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>message" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/message') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3 relative">
                                ✉️
                                <?php
                                $recentMessageCount = session()->get('recentMessageCount');
                                if ($recentMessageCount): ?>
                                    <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center"><?= $recentMessageCount ?></span>
                                <?php endif ?>
                            </span>
                            Messages
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>media-library" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/media-library') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">📂</span>
                            Media Library
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>tag" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/tag') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">🏷️</span>
                            Tags
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>dashboard/article" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/dashboard/article') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">📄</span>
                            Articles
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>dashboard/project" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/dashboard/project') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">📁</span>
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>activity" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/activity') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">🔄</span>
                            Activities
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>setting" class="flex items-center p-3 rounded-lg text-white" :class="isActive('/setting') ? 'bg-lime-600' : 'hover:bg-gray-700'">
                            <span class="mr-3">⚙️</span>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <button @click="logout" class="flex items-center justify-center w-full p-3 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    <span class="mr-2">⬅️</span>
                    Sign Out
                </button>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">
                    Dashboard
                </h1>
                <span class="text-sm text-gray-500" x-text="'Last updated: ' + lastUpdated"></span>
            </div>

            <!-- Loading Indicator -->
            <div x-show="isLoading" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                <div class="loading-spinner rounded-full h-12 w-12 border-t-2 border-b-2 border-lime-600"></div>
            </div>

            <!-- Dashboard Content -->
            <?= $content ?>
        </main>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('dashboard', () => ({
                isLoading: false,
                lastUpdated: new Date().toLocaleString(),
                currentRoute: window.location.pathname,

                balance: <?= isset($dashboardData['balance']) ? $dashboardData['balance'] : 'null' ?>,
                incomeTotal: <?= isset($dashboardData['in']) ? $dashboardData['in'] : 'null' ?>,
                expenseTotal: <?= isset($dashboardData['out']) ? $dashboardData['out'] : 'null' ?>,

                incomeSources: <?= isset($dashboardData['walletIncomes']) ? json_encode($dashboardData['walletIncomes']) : '[]' ?>,
                expenseCategories: <?= isset($dashboardData['walletExpenses']) ? json_encode($dashboardData['walletExpenses']) : '[]' ?>,

                init() {
                    window.addEventListener('popstate', () => {
                        this.currentRoute = window.location.pathname;
                    });

                    if (this.currentRoute === '/dashboard') {
                        this.initCharts();
                    }

                    document.querySelectorAll('aside a').forEach(link => {
                        link.addEventListener('click', (e) => {
                            if (link.href !== window.location.href) {
                                this.isLoading = true;
                                this.currentRoute = new URL(link.href).pathname;
                            }
                        });
                    });
                },

                isActive(route) {
                    return this.currentRoute === route ||
                        (route !== '/dashboard' && this.currentRoute.startsWith(route));
                },

                logout() {
                    this.isLoading = true;
                    window.location.href = '/logout';
                },

                initCharts() {
                    const incomeChartOptions = {
                        chart: {
                            type: 'bar',
                            height: '100%',
                            toolbar: { show: false },
                            animations: { enabled: true }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                borderRadius: 4,
                            }
                        },
                        dataLabels: { enabled: false },
                        colors: ['#10B981'],
                        series: [{
                            name: 'Amount',
                            data: this.incomeSources.map(item => parseFloat(item.total_income))
                        }],
                        xaxis: {
                            categories: this.incomeSources.map(item => item.wallet_name || 'Uncategorized'),
                            labels: {
                                formatter: (value) => '£' + value.toFixed(2)
                            },
                            title: {
                                text: 'Amount (£)',
                                offsetY: 10
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Income Sources',
                                offsetX: 10
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: (value) => '£' + value.toFixed(2)
                            }
                        }
                    };

                    const incomeChart = new ApexCharts(document.getElementById("incomeChart"), incomeChartOptions);
                    incomeChart.render();

                    const expenseChartOptions = {
                        chart: {
                            type: 'bar',
                            height: '100%',
                            toolbar: { show: false },
                            animations: { enabled: true }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                borderRadius: 4,
                            }
                        },
                        dataLabels: { enabled: false },
                        colors: ['#EF4444'],
                        series: [{
                            name: 'Amount',
                            data: this.expenseCategories.map(item => parseFloat(item.total_expense))
                        }],
                        xaxis: {
                            categories: this.expenseCategories.map(item => item.wallet_name || 'Uncategorized'),
                            labels: {
                                formatter: (value) => '£' + value.toFixed(2)
                            },
                            title: {
                                text: 'Amount (£)',
                                offsetY: 10
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Expense Categories',
                                offsetX: 10
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: (value) => '£' + value.toFixed(2)
                            }
                        }
                    };

                    const expenseChart = new ApexCharts(document.getElementById("expenseChart"), expenseChartOptions);
                    expenseChart.render();
                }
            }));
        });

        window.addEventListener('load', function () {
            Alpine.store('isLoading', false);
        });
    </script>
</body>
</html>