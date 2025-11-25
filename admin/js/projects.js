const projectChannel1 = new BroadcastChannel('project_add');
const projectChannel2 = new BroadcastChannel('project_delete');

document.getElementById('projectForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('actions/addProject.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                this.reset();
                closeModal('modal-projects');

                projectChannel1.postMessage({
                    action: 'add',
                    project: data.data
                });
            }
        });
});

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-delete-project")) {
        let id = e.target.dataset.id;

        let fd = new FormData();
        fd.append("project_id", id);

        fetch("actions/deleteProject.php", {
            method: "POST",
            body: fd
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    closeModal('delete-projects');
                    alert(data.message);

                    const row = document.querySelector(`tr[data-id='${id}']`);
                    if (row) row.remove();

                    projectChannel2.postMessage({
                        action: "delete",
                        id: id
                    });
                }
            });
    }
});
