export function initForm() {
    const form = document.querySelector("form.validate");
    if (!form) return;

    form.addEventListener("submit", (e) => {
        let ok = true;

        const name = form.querySelector("[name='name']");
        const email = form.querySelector("[name='email']");
        const message = form.querySelector("[name='message']");

        form.querySelectorAll(".error").forEach(el => el.classList.remove("error"));

        if (name.value.trim().length < 2) {
            name.classList.add("error");
            ok = false;
        }

        const reg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!reg.test(email.value)) {
            email.classList.add("error");
            ok = false;
        }

        if (message.value.trim().length < 10) {
            message.classList.add("error");
            ok = false;
        }

        if (!ok) {
            e.preventDefault();
            alert("Veuillez corriger les erreurs avant d’envoyer.");
        }
    });
}
