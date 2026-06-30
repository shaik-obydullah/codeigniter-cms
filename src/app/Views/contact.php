<?= view('layout/header', ['title' => 'Contact - Shaik Obydullah', 'activeNav' => 'contact']) ?>

<section class="pt-28 pb-20 bg-gray-900 min-h-screen">
    <div class="w-full max-w-4xl mx-auto px-6">
        <h1 class="text-4xl font-bold text-white text-center mb-4">Get In Touch</h1>
        <p class="text-gray-400 text-center mb-12 max-w-xl mx-auto">Have a project in mind or just want to say hi? Fill out the form below and I'll get back to you as soon as possible.</p>

        <div class="flex flex-col lg:flex-row gap-10">
            <div class="flex-1">
                <form class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                            <input type="text" placeholder="Your name" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input type="email" placeholder="your@email.com" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Subject</label>
                        <input type="text" placeholder="What's this about?" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Message</label>
                        <textarea rows="5" placeholder="Your message..." class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white text-sm focus:outline-none focus:ring-2 focus:ring-lime-500 placeholder-gray-500 resize-none"></textarea>
                    </div>
                    <button type="submit" class="bg-lime-500 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-lime-400 transition text-sm">Send Message</button>
                </form>
            </div>

            <aside class="w-full lg:w-72 shrink-0 space-y-6">
                <div class="bg-gray-800 rounded-xl p-5">
                    <h3 class="text-lg font-semibold text-white mb-4">Contact Info</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-center gap-3"><i class="fas fa-envelope text-lime-500 w-4"></i>contact@obydullah.com</li>
                        <li class="flex items-center gap-3"><i class="fas fa-phone text-lime-500 w-4"></i>+880 1700-000000</li>
                        <li class="flex items-center gap-3"><i class="fas fa-map-marker-alt text-lime-500 w-4"></i>Dhaka, Bangladesh</li>
                    </ul>
                </div>
                <div class="bg-gray-800 rounded-xl p-5">
                    <h3 class="text-lg font-semibold text-white mb-4">Follow Me</h3>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-github text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter text-xl"></i></a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?= view('layout/footer') ?>
