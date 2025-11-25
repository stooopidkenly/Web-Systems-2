const certAdd = new BroadcastChannel('certAdd');
const certDeleteChannel = new BroadcastChannel('cert_delete');

certAdd.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === 'add' && msg.cert) {
        const grid = document.querySelector('.cert-grid');
        if (!grid) return;

        // Prevent duplicates
        if (document.querySelector(`.cert-card[data-id="${msg.cert.id}"]`)) {
            return;
        }

        const card = document.createElement('div');
        card.classList.add('cert-card');
        card.setAttribute('data-id', msg.cert.id);

        card.innerHTML = `
            <img
                src="${msg.cert.certs}"
                class="cert-img"
                alt="${msg.cert.name}"
                onclick="openCert('${msg.cert.certs}')"
            >
            <h3 class="cert-name">${msg.cert.name}</h3>
        `;

        grid.appendChild(card);
    }
};

certDeleteChannel.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === "delete") {
        const card = document.querySelector(`.cert-card[data-id='${msg.id}']`);
        if (card) card.remove();
    }
};
