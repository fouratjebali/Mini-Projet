import { initRouter } from "./router.js";
import { initCarousel } from "./carousel.js";
import { initLikes, initComments } from "./likes.js";
import { initMenu } from "./menu.js";
import { initTestimonials } from "./testimonials.js";
import { initForm } from "./form.js";

document.addEventListener("DOMContentLoaded", () => {
    initRouter();
    initCarousel();
    initLikes();
    initComments();
    initMenu();
    initTestimonials();
    initForm();
});
