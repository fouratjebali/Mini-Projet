export function initTestimonials() {
    const items = document.querySelectorAll(".testimonial");
    if (!items.length) return;

    let index = 0;

    setInterval(() => {
        items.forEach((el, i) => {
            el.style.opacity = i === index ? 1 : 0;
        });
        index = (index + 1) % items.length;
    }, 5000);
}
