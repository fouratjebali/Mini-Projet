export function initMenu() {
    let last = 0;
    const header = document.querySelector(".header");

    window.addEventListener("scroll", () => {
        const current = window.scrollY;

        if (current > last && current > 80) {
            header.style.transform = "translateY(-100%)";
        } else {
            header.style.transform = "translateY(0)";
        }

        last = current;
    });
}
