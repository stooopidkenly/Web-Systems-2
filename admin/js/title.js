const titleChannel = new BroadcastChannel('title_add');

document.getElementById('titleForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch('actions/addTitle.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                alert("Title added!");
                closeModal('modal-titles');
                this.reset();

                // Add to table in delete modal
                const tbody = document.querySelector("#titlesTable tbody");
                if (tbody) {
                    const tr = document.createElement("tr");
                    tr.setAttribute("data-id", data.data.id);
                    tr.innerHTML = `
                    <td>${data.data.title}</td>
                    <td><button class="btn-delete-title" data-id="${data.data.id}">Delete</button></td>
                `;
                    tbody.appendChild(tr);
                    tr.querySelector(".btn-delete-title").addEventListener("click", deleteTitleHandler);
                }

                // Broadcast to user side if needed
                titleChannel.postMessage({ action: "add", title: data.data });
            } else {
                alert(data.message);
            }
        });
});

// Delete handler
function deleteTitleHandler() {
    let id = this.getAttribute("data-id");
    if (!confirm("Delete this title?")) return;

    fetch("actions/deleteTitle.php", {
        method: "POST",
        body: new URLSearchParams({ id })
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                const row = document.querySelector(`tr[data-id='${id}']`);
                if (row) row.remove();
            } else {
                alert(data.message);
            }
        });
}

// attach delete listener to existing buttons
document.querySelectorAll(".btn-delete-title").forEach(btn => btn.addEventListener("click", deleteTitleHandler));
