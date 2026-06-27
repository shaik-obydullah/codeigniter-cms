<div x-data="prayerTimesManager()" x-init="fetchPrayerTimes()" class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-4 md:p-8" x-cloak>
    <header class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Prayer Times for Cardiff</h1>
        <div class="flex justify-center items-center gap-4">
            <p class="text-gray-600" x-text="hijriDate"></p>
            <span class="text-gray-400 hidden md:inline">•</span>
            <p class="text-gray-600 hidden md:inline" x-text="gregorianDate"></p>
        </div>
        <p class="text-sm text-gray-500 mt-2" x-text="timezoneDisplay"></p>
    </header>

    <!-- Loading State -->
    <template x-if="loading">
        <div class="flex flex-col items-center justify-center py-12 space-y-3">
            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-lime-500"></div>
            <p class="text-gray-500">Loading prayer times...</p>
        </div>
    </template>

    <!-- Error State -->
    <template x-if="error">
        <div class="max-w-md mx-auto bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800" x-text="error"></h3>
                    <button @click="fetchPrayerTimes()" class="mt-2 text-sm text-red-700 underline hover:text-red-800 transition-colors">
                        Try again
                    </button>
                </div>
            </div>
        </div>
    </template>

    <!-- Main Content -->
    <template x-if="!loading && !error">
        <div class="space-y-6 max-w-4xl mx-auto">
            <!-- Current Prayer Time Highlight -->
            <div x-show="currentPrayer" class="bg-lime-50 border-l-4 border-lime-500 p-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-lime-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-lime-800">
                            <span x-text="currentPrayer"></span> until <span class="font-semibold" x-text="nextPrayerTime"></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Prayer Times Grid -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <template x-for="(time, name) in filteredTimings" :key="name">
                    <div class="bg-white shadow rounded-lg p-4 transition-all hover:shadow-md flex flex-col items-center" 
                         :class="{'ring-2 ring-lime-500': currentPrayerName === name}">
                        <h2 class="text-lg font-semibold text-gray-700" x-text="name"></h2>
                        <p class="text-xl text-lime-600 font-bold mt-1" x-text="time"></p>
                        <template x-if="currentPrayerName === name">
                            <span class="mt-1 text-xs bg-lime-100 text-lime-800 px-2 py-0.5 rounded-full">Now</span>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>

<script>
    function prayerTimesManager() {
        return {
            loading: true,
            error: null,
            timings: {},
            filteredTimings: {},
            hijriDate: '',
            gregorianDate: '',
            timezone: '',
            timezoneOffset: '',
            currentPrayerName: '',
            currentPrayer: '',
            nextPrayerTime: '',

            get timezoneDisplay() {
                return this.timezoneOffset 
                    ? `Timezone: ${this.timezone} (UTC${this.timezoneOffset})` 
                    : `Timezone: ${this.timezone}`;
            },

            async fetchPrayerTimes() {
                try {
                    this.loading = true;
                    this.error = null;
                    
                    const response = await fetch('https://api.aladhan.com/v1/timingsByCity?city=Cardiff&country=UK&method=3');
                    const data = await response.json();

                    if (data.code === 200) {
                        this.processApiData(data.data);
                    } else {
                        this.error = 'Failed to fetch prayer times. Please try again later.';
                    }
                } catch (err) {
                    this.error = 'Network error. Please check your internet connection.';
                    console.error('Error fetching prayer times:', err);
                } finally {
                    this.loading = false;
                }
            },

            processApiData(data) {
                this.timings = data.timings;
                const {Sunrise, Imsak, Midnight, ...filtered} = this.timings;
                this.filteredTimings = filtered;

                const hijri = data.date.hijri;
                this.hijriDate = `${hijri.day} ${hijri.month.en} ${hijri.year}`;
                
                const gregorian = new Date();
                this.gregorianDate = gregorian.toLocaleDateString('en-US', {
                    weekday: 'long',
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });

                this.timezone = data.meta.timezone;
                this.timezoneOffset = data.meta.timezone_offset;

                this.calculateCurrentPrayer();
            },

            calculateCurrentPrayer() {
                const now = new Date();
                const currentTime = now.getHours() * 60 + now.getMinutes();
                const prayers = [];

                for (const [name, time] of Object.entries(this.filteredTimings)) {
                    const [hours, minutes] = time.split(':').map(Number);
                    prayers.push({
                        name,
                        time,
                        totalMinutes: hours * 60 + minutes
                    });
                }

                prayers.sort((a, b) => a.totalMinutes - b.totalMinutes);

                let current = null;
                let next = null;

                for (const prayer of prayers) {
                    if (prayer.totalMinutes > currentTime) {
                        next = prayer;
                        break;
                    }
                    current = prayer;
                }

                if (!next && prayers.length > 0) {
                    next = prayers[0];
                }

                if (current) {
                    this.currentPrayerName = current.name;
                    this.currentPrayer = `${current.name} prayer`;
                    this.nextPrayerTime = next ? next.time : '';
                } else if (next) {
                    this.currentPrayer = `Waiting for ${next.name}`;
                    this.nextPrayerTime = next.time;
                }
            }
        };
    }
</script>