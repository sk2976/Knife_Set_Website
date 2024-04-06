document.addEventListener("DOMContentLoaded", function () {
    let currentIndex = 0;
    const backgrounds = [
        "url('images/ny_skyline.jpg')",
        "url('images/steak_bg.jpg')",
    ];

    function showBackground(index) {
        document.body.style.backgroundImage = backgrounds[index];
    }

    function nextBackground() {
        currentIndex = (currentIndex + 1) % backgrounds.length;
        showBackground(currentIndex);
    }

    showBackground(currentIndex);

    setInterval(nextBackground, 10000);
});
