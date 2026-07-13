<?= view('layout/header', ['title' => 'Contact - Shaik Obydullah', 'activeNav' => 'contact']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen">
    <div class="w-full max-w-2xl mx-auto px-6">
        <h1 class="text-4xl font-bold text-white text-center mb-4">Get In Touch</h1>
        <p class="text-gray-400 text-center mb-12 max-w-xl mx-auto">Have a project in mind or just want to say hi? Fill out the form below and I'll get back to you as soon as possible.</p>

        <div id="form-success" class="bg-green-600 text-white px-6 py-3 rounded-lg mb-8 text-center hidden"></div>
        <div id="form-error" class="bg-red-600 text-white px-6 py-3 rounded-lg mb-8 text-center hidden"></div>

        <form id="contact-form" action="/contact" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                    <input type="text" name="name" required placeholder="Your name" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500" />
                    <p class="text-red-400 text-xs mt-1 hidden" data-error="name"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input type="email" name="email" required placeholder="your@email.com" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500" />
                    <p class="text-red-400 text-xs mt-1 hidden" data-error="email"></p>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Subject</label>
                <input type="text" name="subject" required placeholder="What's this about?" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500" />
                <p class="text-red-400 text-xs mt-1 hidden" data-error="subject"></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Message</label>
                <textarea rows="5" name="message" required placeholder="Your message..." class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500 resize-none"></textarea>
                <p class="text-red-400 text-xs mt-1 hidden" data-error="message"></p>
            </div>
            <button type="submit" id="contact-btn" class="bg-lime-500 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-lime-400 transition text-sm disabled:opacity-50 disabled:cursor-not-allowed">Send Message</button>
        </form>

        <?php
        $socialLinks = [
            'social.linkedin' => 'fa-linkedin-in',
            'social.github'   => 'fa-github',
            'social.twitter'  => 'fa-twitter',
            'social.youtube'  => 'fa-youtube',
        ];
        $visibleSocials = [];
        foreach ($socialLinks as $key => $icon) {
            $val = setting($key);
            if (!empty(trim($val))) {
                $visibleSocials[$val] = $icon;
            }
        }
        if (!empty($visibleSocials)):
        ?>
        <div class="mt-12 text-center">
            <h3 class="text-lg font-semibold text-white mb-4">Follow Me</h3>
            <div class="flex justify-center gap-4">
                <?php foreach ($visibleSocials as $url => $icon): ?>
                <a href="<?= esc($url) ?>" target="_blank" class="text-gray-400 hover:text-white transition"><i class="fab <?= $icon ?> text-xl"></i></a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
document.getElementById('contact-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = this;
    const btn = document.getElementById('contact-btn');
    const successDiv = document.getElementById('form-success');
    const errorDiv = document.getElementById('form-error');

    btn.disabled = true;
    btn.textContent = 'Sending...';
    successDiv.classList.add('hidden');
    errorDiv.classList.add('hidden');

    document.querySelectorAll('[data-error]').forEach(el => {
        el.textContent = '';
        el.classList.add('hidden');
    });

    try {
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            errorDiv.textContent = 'Server error (HTTP ' + response.status + '). Please try again later.';
            errorDiv.classList.remove('hidden');
            return;
        }

        const result = await response.json();

        if (result.success) {
            successDiv.textContent = result.message;
            successDiv.classList.remove('hidden');
            form.reset();
        } else if (result.errors) {
            for (const [field, msg] of Object.entries(result.errors)) {
                const el = document.querySelector(`[data-error="${field}"]`);
                if (el) {
                    el.textContent = msg;
                    el.classList.remove('hidden');
                }
            }
        } else if (result.error) {
            errorDiv.textContent = result.error;
            errorDiv.classList.remove('hidden');
        }
    } catch (err) {
        errorDiv.textContent = 'Error: ' + err.message;
        errorDiv.classList.remove('hidden');
    } finally {
        btn.disabled = false;
        btn.textContent = 'Send Message';
    }
});
</script>

<?= view('layout/footer') ?>
