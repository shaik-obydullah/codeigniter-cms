// Loading Animation
window.addEventListener("load", () => {
  document.getElementById("loading").style.display = "none";
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    document.querySelector(this.getAttribute("href")).scrollIntoView({
      behavior: "smooth",
    });
  });
});

// Back to Top Button
const backToTopButton = document.getElementById("back-to-top");

window.addEventListener("scroll", () => {
  if (window.scrollY > 300) {
    backToTopButton.classList.remove("hidden");
  } else {
    backToTopButton.classList.add("hidden");
  }
});

backToTopButton.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

// Matrix Binary Effect
const matrixCanvas = document.getElementById("matrix-canvas");
const ctx = matrixCanvas.getContext("2d");

// Set canvas size
matrixCanvas.width = window.innerWidth;
matrixCanvas.height = window.innerHeight;

// Binary characters
const binary = "01010101010101010101010101010101";
const columns = Math.floor(matrixCanvas.width / 20); // Adjust column width
const drops = Array(columns).fill(0); // Track y-positions of drops

// Draw the matrix effect
function drawMatrix() {
  // Semi-transparent black background
  ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
  ctx.fillRect(0, 0, matrixCanvas.width, matrixCanvas.height);

  // Green text
  ctx.fillStyle = "lime";
  ctx.font = "15px monospace";

  // Draw binary characters
  for (let i = 0; i < drops.length; i++) {
    const text = binary[Math.floor(Math.random() * binary.length)];
    const x = i * 20;
    const y = drops[i] * 20;

    ctx.fillText(text, x, y);

    // Reset drop if it reaches the bottom
    if (y > matrixCanvas.height && Math.random() > 0.975) {
      drops[i] = 0;
    }

    // Move drop down
    drops[i]++;
  }
}

// Animation loop
setInterval(drawMatrix, 50);

// Resize canvas on window resize
window.addEventListener("resize", () => {
  matrixCanvas.width = window.innerWidth;
  matrixCanvas.height = window.innerHeight;
});