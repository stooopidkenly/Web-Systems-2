const certAdd = new BroadcastChannel('certAdd');
const certDeleteChannel = new BroadcastChannel('cert_delete');

document.getElementById('certForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('actions/addCert.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);

                // SEND REAL DATA TO LISTENER
                certAdd.postMessage({
                    action: 'add',
                    cert: data.data
                });

                document.getElementById('certForm').reset();
                closeModal('modal-certs');
            } else {
                alert(data.message);
            }
        })
        .catch(err => console.error(err));
});

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-delete-cert")) {

        let id = e.target.dataset.id;

        let fd = new FormData();
        fd.append("cert_id", id);

        fetch("actions/deleteCert.php", {
            method: "POST",
            body: fd
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);

                    const row = document.querySelector(`tr[data-id='${id}']`);
                    if (row) row.remove();

                    certDeleteChannel.postMessage({
                        action: "delete",
                        id: id
                    });
                }
            });
    }
});