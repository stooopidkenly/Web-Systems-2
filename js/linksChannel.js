const linkAdd = new BroadcastChannel('link_add');

linkAdd.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === "add" && msg.link) {

        const container = document.querySelector('.socialLinks');
        if (!container) return;

        // prevent duplicate
        if (document.querySelector(`a[data-id="${msg.link.id}"]`)) {
            return;
        }

        const a = document.createElement('a');
        a.href = msg.link.link;
        a.target = "_blank";
        a.setAttribute('aria-label', msg.link.platform + " Profile");
        a.setAttribute('data-id', msg.link.id);

        const icon = document.createElement('i');
        icon.className = "fab fa-" + msg.link.platform.toLowerCase().replace(/ /g, '-');

        a.appendChild(icon);
        container.appendChild(a);
    }
};

const linkDelete = new BroadcastChannel('link_delete');

linkDelete.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === "delete") {
        const el = document.querySelector(`a[data-id="${msg.id}"]`);
        if (el) el.remove();
    }
};