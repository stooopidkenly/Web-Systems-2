const channel1 = new BroadcastChannel('skills');
const channel2 = new BroadcastChannel('updatedSkills');
const channel3 = new BroadcastChannel('deletedSkills');

const skillsForm = document.getElementById('skillsForm');
if (skillsForm) {
    skillsForm.addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch('actions/addSkill.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    skillsForm.reset();
                    alert(data.message);
                    closeModal('modal-skills');
                    channel1.postMessage({
                        action: 'add',
                        skill: data.data
                    });
                }
            })
            .catch(err => console.log("AJAX ERROR:", err));
    });
}

// OPEN UPDATE MODAL
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('update-btn')) {

        const row = e.target.closest('tr');

        const id = row.dataset.id;
        const name = row.dataset.name;
        const level = row.dataset.level;

        document.getElementById('updateSkillId').value = id;
        document.getElementById('updateSkillName').value = name;
        document.getElementById('updateSkillLevel').value = level;

        document.getElementById('updateSkillModal').style.display = 'flex';
    }

    if (e.target.id === 'closeUpdateModal') {
        document.getElementById('updateSkillModal').style.display = 'none';
    }
});


// ✅ SUBMIT UPDATE
const updateForm = document.getElementById('updateSkillForm');

if (updateForm) {
    updateForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('actions/updateSkill.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {

                    const row = document.querySelector(`tr[data-id="${data.data.id}"]`);
                    if (row) {
                        row.dataset.name = data.data.skillName;
                        row.dataset.level = data.data.skillLevel;

                        row.cells[0].textContent = data.data.skillName;
                        row.cells[1].textContent = data.data.skillLevel;
                    }

                    alert(data.message);

                    channel2.postMessage({
                        action: 'update',
                        skill: data.data
                    });
                }
            });

        document.getElementById('updateSkillModal').style.display = 'none';
    });
}


// ✅ DELETE
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-btn')) {

        const row = e.target.closest('tr');
        const id = row.dataset.id;

        if (!confirm('Delete this skill?')) return;

        const formData = new FormData();
        formData.append('id', id);

        fetch('actions/deleteSkill.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);

                    row.remove();

                    channel3.postMessage({
                        action: 'delete',
                        id: id
                    });
                } else {
                    alert(data.message || 'Failed to delete skill');
                }
            })
            .catch(err => console.log("DELETE ERROR:", err));
    }
});