<footer class="bg-gray-800 text-white py-6 text-center">
    <p class="text-sm">&copy; 2026 Shaik Obydullah. All Rights Reserved.</p>
    <div class="flex justify-center gap-4 mt-2 text-xs text-gray-500">
        <a href="/privacy" class="hover:text-gray-300 transition">Privacy Policy</a>
        <a href="/terms" class="hover:text-gray-300 transition">Terms of Service</a>
    </div>
</footer>

<button id="back-to-top" class="fixed bottom-8 right-8 bg-white text-gray-900 p-3 rounded-full shadow-lg hover:bg-gray-200 transition hidden">&uarr;</button>

<?php if (isset($extraScripts)) echo $extraScripts; ?>

<script>
window.addEventListener("load", () => { document.getElementById("loading").style.display = "none"; });

const menuToggle = document.getElementById("menu-toggle");
const mobileMenu = document.getElementById("mobile-menu");
if (menuToggle) {
    menuToggle.addEventListener("click", () => {
        mobileMenu.classList.toggle("open");
        menuToggle.classList.toggle("active");
    });
    mobileMenu.querySelectorAll("a").forEach((l) => {
        l.addEventListener("click", () => {
            mobileMenu.classList.remove("open");
            menuToggle.classList.remove("active");
        });
    });
}

const navbar = document.getElementById("navbar");
window.addEventListener("scroll", () => { navbar.classList.toggle("bg-gray-900/95", window.scrollY > 50); });

const backToTopButton = document.getElementById("back-to-top");
window.addEventListener("scroll", () => { backToTopButton.classList.toggle("hidden", window.scrollY <= 300); });
if (backToTopButton) {
    backToTopButton.addEventListener("click", () => { window.scrollTo({ top: 0, behavior: "smooth" }); });
}

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) target.scrollIntoView({ behavior: "smooth" });
    });
});
</script>
</body>
</html>
