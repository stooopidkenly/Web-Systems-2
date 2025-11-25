const titleAdd = new BroadcastChannel('title_add');
const titleDelete = new BroadcastChannel('title_delete');

const titleContainer = document.querySelector(".rotatingTitles");

titleAdd.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === "add") {
        const span = document.createElement("span");
        span.setAttribute("data-id", msg.title.id);
        span.textContent = msg.title.title;

        titleContainer.appendChild(span);
    }
};

titleDelete.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === "delete") {
        const item = document.querySelector(`.rotatingTitles [data-id="${msg.id}"]`);
        if (item) item.remove();
    }
};