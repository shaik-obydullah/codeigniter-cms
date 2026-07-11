<?= view('layout/header', ['title' => 'FAQ - Shaik Obydullah', 'activeNav' => 'faq']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen">
    <div class="w-full max-w-3xl mx-auto px-6">
        <h1 class="text-4xl font-bold text-white text-center mb-4">Frequently Asked Questions</h1>
        <p class="text-gray-400 text-center mb-12">Quick answers to common questions. Don't see yours? <a href="/contact" class="text-lime-500 hover:text-lime-400 transition">Get in touch</a>.</p>

        <div class="space-y-3">
            <?php
            $faqs = [
                ['q' => 'What technologies do you specialize in?', 'a' => 'I specialize in Laravel, Next.js, and MySQL. I\'m also experienced with React, Vue.js, Docker, and various cloud platforms like AWS.'],
                ['q' => 'How can I hire you for a project?', 'a' => 'You can reach out via the <a href="/contact" class="text-lime-500 hover:text-lime-400 transition">contact page</a> with details about your project. I\'ll review and get back to you within 24-48 hours with a proposal and timeline.'],
                ['q' => 'Do you offer ongoing maintenance or support?', 'a' => 'Yes, I offer maintenance packages for existing projects including bug fixes, updates, performance optimization, and feature enhancements. We can discuss a plan that fits your needs.'],
                ['q' => 'What is the typical project timeline?', 'a' => 'Timelines vary by project scope. A typical web application takes 4-12 weeks from concept to launch. I\'ll provide a detailed timeline during the proposal phase.'],
                ['q' => 'How do you handle revisions and feedback?', 'a' => 'I work in iterative cycles with regular check-ins. Feedback is incorporated at each stage, ensuring the final product aligns with your vision. Revision rounds are outlined in the project agreement.'],
                ['q' => 'Do you work with clients remotely?', 'a' => 'Absolutely. I work remotely with clients worldwide. Communication happens via email, Slack, Zoom, or any platform you prefer. Time zone differences are never a problem.'],
                ['q' => 'What is your pricing model?', 'a' => 'I offer both fixed-price and hourly rates depending on the project. Fixed-price works best for well-defined projects, while hourly is ideal for ongoing work or evolving requirements.'],
            ];
            foreach ($faqs as $faq): ?>
            <details class="bg-gray-800 rounded-xl group">
                <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
                    <span class="text-white font-medium"><?= $faq['q'] ?></span>
                    <i class="fas fa-chevron-down text-gray-400 chevron transition-transform duration-200"></i>
                </summary>
                <div class="px-5 pb-5 text-sm text-gray-300 leading-relaxed"><?= $faq['a'] ?></div>
            </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
