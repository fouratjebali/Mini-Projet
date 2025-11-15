export function initRouter() {
    const content = document.querySelector("#contenu");
    if (!content) return;

    async function loadPage(url, addToHistory = true) {
        try {
            const res = await fetch(url);
            const html = await res.text();

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, "text/html");
            const newMain = doc.querySelector("main");

            if (newMain) {
                content.innerHTML = newMain.innerHTML;
                document.title = doc.title;

                if (addToHistory) {
                    history.pushState({ url }, "", url);
                }

                window.scrollTo(0, 0);
            }
        } catch (e) {
            console.error("Erreur chargement page :", e);
        }
    }

    document.body.addEventListener("click", (e) => {
        const a = e.target.closest("a");
        if (!a) return;

        const url = a.getAttribute("href");

        if (url && !url.startsWith("http") && !url.startsWith("#")) {
            e.preventDefault();
            loadPage(url);
        }
    });

    window.addEventListener("popstate", (e) => {
        if (e.state?.url) {
            loadPage(e.state.url, false);
        }
    });
}
