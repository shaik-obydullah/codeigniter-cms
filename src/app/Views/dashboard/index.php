<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8">
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">💰 Financial Dashboard</h1>
        <p class="text-gray-500">Updated in real-time</p>
    </header>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <!-- Balance Card -->
        <div class="p-6 rounded-xl shadow-sm" :class="balance < 0 ? 'bg-red-50' : 'bg-green-50'" class="border border-gray-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Balance</p>
                    <p class="text-3xl font-bold" :class="balance < 0 ? 'text-red-600' : 'text-green-600'" x-text="'£' + balance.toFixed(2)">
                    </p>
                </div>
                <span class="text-2xl p-2 rounded-lg bg-gray-800 text-white shadow-xs">💰</span>
            </div>
            <p class="text-xs mt-2 text-gray-500" x-text="balance >= 0 ? 'Positive cash flow' : 'Negative cash flow'">
            </p>
        </div>

        <!-- Income Card -->
        <div class="p-6 rounded-xl shadow-sm bg-green-50 border border-gray-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Incomes</p>
                    <p class="text-3xl font-bold text-green-600" x-text="'£' + incomeTotal.toFixed(2)"></p>
                </div>
                <span class="text-2xl p-2 rounded-lg bg-gray-800 text-white shadow-xs">↑</span>
            </div>
            <p class="text-xs mt-2 text-gray-500" x-text="'From ' + incomeSources.length + ' sources'">
            </p>
        </div>

        <!-- Expenses Card -->
        <div class="p-6 rounded-xl shadow-sm bg-red-50 border border-gray-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Expenses</p>
                    <p class="text-3xl font-bold text-red-600" x-text="'£' + expenseTotal.toFixed(2)"></p>
                </div>
                <span class="text-2xl p-2 rounded-lg bg-gray-800 text-white shadow-xs">↓</span>
            </div>
            <p class="text-xs mt-2 text-gray-500" x-text="'Across ' + expenseCategories.length + ' categories'">
            </p>
        </div>
    </div>

    <!-- Charts -->
    <div class="space-y-8">
        <!-- Income Chart -->
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Income Sources</h2>
            <div id="incomeChart" class="h-72 w-full"></div>
        </div>

        <!-- Expenses Chart -->
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Expense Breakdown</h2>
            <div id="expenseChart" class="h-72 w-full"></div>
        </div>
    </div>
</div>