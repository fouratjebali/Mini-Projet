export function initLikes() {
    document.querySelectorAll(".like-btn").forEach(btn => {
        const id = btn.dataset.id;
        if (!id) return;

        const countSpan = btn.querySelector(".like-count");
        if (!countSpan) return;

        let likes = parseInt(localStorage.getItem("likes-" + id) || "0");
        countSpan.textContent = likes;

        btn.addEventListener("click", () => {
            likes++;
            localStorage.setItem("likes-" + id, likes);
            countSpan.textContent = likes;
        });
    });
}


export function initComments() {
    document.querySelectorAll(".comment-form").forEach(form => {
        const id = form.dataset.id;
        if (!id) return;

        const input = form.querySelector("input");
        const list = document.querySelector(`.comments[data-id="${id}"]`);

        let comments = JSON.parse(localStorage.getItem("comments-" + id) || "[]");

        list.innerHTML = comments.map(c => `<p>🗨️ ${c}</p>`).join("");

        form.addEventListener("submit", e => {
            e.preventDefault();
            const txt = input.value.trim();
            if (!txt) return;

            comments.push(txt);
            localStorage.setItem("comments-" + id, JSON.stringify(comments));

            list.innerHTML += `<p>🗨️ ${txt}</p>`;
            input.value = "";
        });
    });
}
