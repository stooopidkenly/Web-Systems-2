const linkAdd = new BroadcastChannel('link_add');
const linkDelete = new BroadcastChannel('link_delete');

document.getElementById("linkForm").addEventListener("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("actions/addLinks.php", {
        method: "POST",
        body: formData
    })
        .then(res => res.json())
        .then(data => {

            if (data.status === "success") {
                alert("Link added!");

                // SEND TO USER SIDE
                linkAdd.postMessage({
                    action: "add",
                    link: data.data
                });

                document.getElementById("linkForm").reset();
                closeModal('modal-links');

            } else {
                alert(data.message);
            }
        })
        .catch(err => console.error(err));
});

document.querySelectorAll(".btn-delete-link").forEach(btn => {
    btn.addEventListener("click", function () {

        let id = this.getAttribute("data-id");

        if (!confirm("Delete this link?")) return;

        fetch("actions/deleteLinks.php", {
            method: "POST",
            body: new URLSearchParams({ id: id })
        })
            .then(res => res.json())
            .then(data => {

                if (data.status === "success") {

                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) row.remove();

                    linkDelete.postMessage({
                        action: "delete",
                        id: id
                    });
                } else {
                    alert(data.message);
                }
            })
            .catch(err => console.error(err));
    });
});
