<?= view('layout/header', ['title' => 'About - Shaik Obydullah', 'activeNav' => 'about']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen">
    <div class="w-full max-w-4xl mx-auto px-6">
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 md:p-10">
            <div class="border-b border-gray-700 pb-6 mb-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-4xl font-bold text-white">Shaik Obydullah</h1>
                        <p class="text-lg text-lime-500 mt-1">Software Engineer</p>
                        <p class="text-sm text-gray-400 mt-1">Dhaka, Bangladesh | contact@obydullah.com | +880 1700-000000</p>
                        <p class="text-sm text-gray-400">linkedin.com/in/obydullah | github.com/obydullah</p>
                    </div>
                    <a href="#" onclick="window.print()" class="shrink-0 bg-lime-500 text-gray-900 px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-lime-400 transition flex items-center gap-2"><i class="fas fa-download"></i> Download PDF</a>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-lg font-bold text-white border-b border-gray-700 pb-2 mb-3">Professional Summary</h2>
                <p class="text-sm text-gray-300 leading-relaxed">Passionate software engineer with over 5 years of experience designing and building scalable web applications. Specializing in Laravel, Next.js, and MySQL, with a proven track record of delivering high-quality solutions that drive business growth. Adept at leading development teams, architecting RESTful APIs, and optimizing database performance.</p>
            </div>

            <div class="mb-8">
                <h2 class="text-lg font-bold text-white border-b border-gray-700 pb-2 mb-3">Skills</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                    <div><span class="text-gray-400">Backend:</span> <span class="text-gray-200">Laravel, PHP, REST APIs, Livewire</span></div>
                    <div><span class="text-gray-400">Frontend:</span> <span class="text-gray-200">Next.js, React, Vue.js, Tailwind CSS</span></div>
                    <div><span class="text-gray-400">Database:</span> <span class="text-gray-200">MySQL, MongoDB, Redis</span></div>
                    <div><span class="text-gray-400">DevOps:</span> <span class="text-gray-200">Docker, Nginx, CI/CD, AWS</span></div>
                    <div><span class="text-gray-400">Tools:</span> <span class="text-gray-200">Git, GitHub Actions, Stripe, PayPal</span></div>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-lg font-bold text-white border-b border-gray-700 pb-2 mb-3">Work Experience</h2>
                <div class="mb-6">
                    <div class="flex justify-between items-start flex-wrap">
                        <div><h3 class="font-semibold text-white">Senior Software Engineer</h3><p class="text-sm text-lime-500">TechCorp Solutions</p></div>
                        <p class="text-xs text-gray-500 whitespace-nowrap">2023 - Present</p>
                    </div>
                    <ul class="mt-2 text-sm text-gray-300 list-disc pl-5 space-y-1">
                        <li>Led development of a microservices-based platform serving 50k+ users.</li>
                        <li>Architected RESTful APIs and optimized database queries, reducing response times by 40%.</li>
                        <li>Mentored 3 junior developers through code reviews and pair programming.</li>
                    </ul>
                </div>
                <div class="mb-6">
                    <div class="flex justify-between items-start flex-wrap">
                        <div><h3 class="font-semibold text-white">Software Engineer</h3><p class="text-sm text-lime-500">WebStudio Agency</p></div>
                        <p class="text-xs text-gray-500 whitespace-nowrap">2020 - 2023</p>
                    </div>
                    <ul class="mt-2 text-sm text-gray-300 list-disc pl-5 space-y-1">
                        <li>Built 10+ client-facing web applications using Laravel and Next.js.</li>
                        <li>Integrated payment gateways (Stripe, PayPal) and third-party APIs.</li>
                        <li>Implemented CI/CD pipelines reducing deployment time by 60%.</li>
                    </ul>
                </div>
                <div>
                    <div class="flex justify-between items-start flex-wrap">
                        <div><h3 class="font-semibold text-white">Junior Developer</h3><p class="text-sm text-lime-500">StartupHub</p></div>
                        <p class="text-xs text-gray-500 whitespace-nowrap">2019 - 2020</p>
                    </div>
                    <ul class="mt-2 text-sm text-gray-300 list-disc pl-5 space-y-1">
                        <li>Developed and maintained company's flagship SaaS product.</li>
                        <li>Wrote unit and integration tests achieving 85% code coverage.</li>
                        <li>Contributed to the frontend migration from jQuery to React.</li>
                    </ul>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-lg font-bold text-white border-b border-gray-700 pb-2 mb-3">Education</h2>
                <div class="mb-4">
                    <div class="flex justify-between items-start flex-wrap">
                        <div><h3 class="font-semibold text-white">B.Tech in Computer Science</h3><p class="text-sm text-lime-500">University of Hyderabad</p></div>
                        <p class="text-xs text-gray-500 whitespace-nowrap">2015 - 2019</p>
                    </div>
                    <p class="mt-1 text-sm text-gray-300">Graduated with Distinction (CGPA: 8.7/10). Specialized in software engineering and database systems.</p>
                </div>
                <div>
                    <div class="flex justify-between items-start flex-wrap">
                        <div><h3 class="font-semibold text-white">Higher Secondary (XII)</h3><p class="text-sm text-lime-500">Sri Chaitanya College</p></div>
                        <p class="text-xs text-gray-500 whitespace-nowrap">2013 - 2015</p>
                    </div>
                    <p class="mt-1 text-sm text-gray-300">Science stream with Mathematics. Scored 92%.</p>
                </div>
            </div>

            <div>
                <h2 class="text-lg font-bold text-white border-b border-gray-700 pb-2 mb-3">Certifications</h2>
                <ul class="text-sm text-gray-300 list-disc pl-5 space-y-1">
                    <li>AWS Certified Developer &ndash; Associate (2024)</li>
                    <li>Laravel Certified Developer (2023)</li>
                    <li>MongoDB Associate Developer (2022)</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
