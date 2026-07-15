<?= view('layout/header', ['title' => 'About - Shaik Obydullah', 'activeNav' => 'about']) ?>

<section class="pt-28 pb-24 bg-gray-900 min-h-screen">
    <div class="w-full max-w-5xl mx-auto px-6">

        <!-- Hero -->
        <div class="mb-5">
            <p class="text-lime-500 text-sm font-semibold tracking-wider uppercase mb-3">About Me</p>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight tracking-tight mb-4">Shaik Obydullah
            </h1>
            <p class="text-lg text-gray-400 leading-relaxed mb-6"><?= esc(setting('site.site_tagline')) ?></p>
            <a href="/contact"
                class="inline-block bg-lime-500 text-gray-900 font-semibold px-5 py-2.5 rounded-xl text-sm hover:bg-lime-400 transition-all shadow-lg shadow-lime-500/10">
                Get in Touch
            </a>
        </div>

        <!-- What I Do -->
        <div class="mb-20 pt-4">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight mb-4">What I Do</h2>
            <div class="w-16 h-1 bg-lime-500 rounded-full mb-10"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Full Stack Software Development</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Build scalable, secure, and high-performance web
                        applications from concept to deployment.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Enterprise Software Development</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Develop ERP, CRM, MIS, accounting, HR, inventory,
                        and other enterprise-grade business solutions.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Custom Business Applications</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Create tailor-made software that automates business
                        processes and improves operational efficiency.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">WordPress Development</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Build custom WordPress themes, plugins, WooCommerce
                        solutions, and Gutenberg-based websites.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">eCommerce Development</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Develop online stores, multivendor marketplaces,
                        POS systems, payment gateways, and order management solutions.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">FinTech & Financial Software</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Build banking, microfinance, accounting,
                        cryptocurrency, payment, and financial management applications.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Government & Public Sector Solutions</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Develop digital platforms for embassies, passport
                        and visa services, citizen portals, and government organizations.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">AI & Business Intelligence</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Integrate artificial intelligence, automation,
                        chatbots, analytics, and business intelligence into enterprise applications.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">API Development & System Integration</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Design secure APIs and integrate third-party
                        platforms, payment gateways, cloud services, and enterprise systems.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Database Design & Optimization</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Design high-performance database architectures,
                        optimize queries, and manage large-scale data efficiently.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Cloud & DevOps</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Deploy, secure, and manage applications using
                        Docker, Linux, CI/CD pipelines, and cloud infrastructure.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Software Consulting</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Help businesses plan, architect, modernize, and
                        scale software solutions using industry best practices.</p>
                </div>
            </div>
        </div>

        <!-- What I Have Done -->
        <div class="mt-5">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight mb-4">What I Have Done</h2>
            <div class="w-16 h-1 bg-lime-500 rounded-full mb-10"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Multivendor eCommerce</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Scalable online marketplace solutions with multiple
                        vendors, product management, orders, payments, and logistics.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">CRM Application</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Customer relationship management systems for sales,
                        leads, customer support, marketing, and business growth.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Business & SME Management Software</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Comprehensive solutions to manage daily operations,
                        employees, inventory, sales, purchasing, and business processes.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Booking Solution System</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Online booking and reservation platforms for
                        hotels, restaurants, clinics, salons, events, and service providers.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Corporate Website & Web Applications</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Modern business websites and custom web
                        applications tailored to organizational requirements.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Job Board</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Recruitment platforms connecting employers and job
                        seekers with job posting, applications, and hiring workflows.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Learning Management System (LMS)</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">E-learning platforms with course management,
                        student enrollment, quizzes, certifications, and progress tracking.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Management Information System (MIS)</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Centralized information systems for reporting,
                        analytics, workflow management, and organizational decision-making.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Custom Business Applications</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Tailor-made software solutions designed to automate
                        unique business processes and operational workflows.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">NGO & Banking Solutions</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Digital solutions for NGOs, charities, cooperative
                        organizations, and banking institutions with secure financial operations.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Enterprise Resource Planning (ERP)</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">End-to-end ERP solutions for clothing buying
                        houses, real estate companies, brick and manufacturing factories, group of companies, inventory,
                        HR, finance, procurement, production, and business operations.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Accounting System</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Accounting software for invoicing, bookkeeping,
                        payroll, taxation, budgeting, and financial reporting.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">AI Training & Large Data Analysis</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">AI-powered applications for model training,
                        automation, predictive analytics, business intelligence, and big data processing.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Business Intelligence (BI)</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Interactive dashboards, reporting, and data
                        visualization solutions that transform business data into actionable insights.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Cryptocurrency Solutions</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Blockchain-based applications including crypto
                        wallets, token management, decentralized applications, and digital asset platforms.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Microfinance & Financial Management Software</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Secure solutions for microfinance institutions,
                        NGOs, cooperative societies, loan management, savings, collections, accounting, and money
                        transfer settlement systems.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Government & Embassy Management Systems</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Digital platforms for embassies, consulates, and
                        government organizations, including passport and visa applications, citizen services,
                        appointments, document verification, and case management.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">MLM & Network Marketing Software</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Multi-level marketing platforms with genealogy
                        trees, commission management, e-wallets, compensation plans, member management, and payout
                        automation.</p>
                </div>
                <div
                    class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700/50 hover:border-gray-700 transition-colors">
                    <h3 class="text-white font-semibold mb-2">Cryptocurrency Trading & Digital Asset Management</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Secure cryptocurrency trading platforms with
                        exchange integration, wallets, portfolio management, KYC/AML compliance, trading automation, and
                        real-time market analytics.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<?= view('layout/footer') ?>