const skillsForm = document.getElementById('skillsForm');

if (skillsForm) {
    skillsForm.addEventListener('submit', function(e){
        e.preventDefault();

        let formData = new FormData(this);

        fetch('actions/addSkill.php',{
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === "success"){
                skillsForm.reset();
                alert(data.message);
                closeModal('modal-skills');

                const channel1 = new BroadcastChannel('skills');
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

        const id    = row.dataset.id;
        const name  = row.dataset.name;
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
document.getElementById('updateSkillForm').addEventListener('submit', function(e){
    e.preventDefault();

    const formData = new FormData(this);

    fetch('actions/updateSkill.php',{
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === "success"){

            alert(data.message);

            // USE THE GLOBAL channel2
            channel2.postMessage({
                action: 'update',
                skill: data.data
            });
        }
    });
});


// ✅ DELETE
document.addEventListener('click', function(e){
    if(e.target.classList.contains('delete-btn')){

        const row = e.target.closest('tr');
        const id = row.dataset.id;

        if(!confirm('Delete this skill?')) return;

        const formData = new FormData();
        formData.append('id', id);

        fetch('actions/deleteSkill.php',{
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === "success"){

                // ✅ Broadcast DELETE
                const channel = new BroadcastChannel('skills');
                channel.postMessage({
                    action: 'delete',
                    id: id
                });

                row.remove();
            }
        });
    }
});