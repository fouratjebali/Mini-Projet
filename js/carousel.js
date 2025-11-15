export function initCarousel() {
    document.querySelectorAll(".carousel").forEach((carousel) => {
        const track = carousel.querySelector(".carousel-track");
        const next = carousel.querySelector(".next");
        const prev = carousel.querySelector(".prev");

        let index = 0;
        const slides = track.children.length;
        const visible = 3;

        function update() {
            const width = track.children[0].offsetWidth;
            track.style.transform = `translateX(${-index * width}px)`;
        }

        next.addEventListener("click", () => {
            if (index < slides - visible) index++;
            update();
        });

        prev.addEventListener("click", () => {
            if (index > 0) index--;
            update();
        });

        window.addEventListener("resize", update);
    });
}
