const eduChannel = new BroadcastChannel('portfolio_edu');

eduChannel.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === 'delete' && msg.id) {
        const eduCard = document.querySelector(`.edu-card[data-id="${msg.id}"]`);
        if (eduCard) {
            eduCard.remove();
        }

        const row = document.querySelector(`#eduTable tr[data-id="${msg.id}"]`);
        if (row) {
            row.remove();
        }
    }
}