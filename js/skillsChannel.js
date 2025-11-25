const channel1 = new BroadcastChannel('skills');
const channel2 = new BroadcastChannel('updatedSkills');
const channel3 = new BroadcastChannel('deletedSkills'); 

// ADD
channel1.onmessage = function(e) {
    const msg = e.data;

    if (msg.action === 'add' && msg.skill) {
        const skillContainer = document.getElementById('skillsContainer');
        if (!skillContainer) return;

        const div = document.createElement('div');
        div.className = 'skill-item';
        div.innerHTML = `
            <div class="skill-info">
                <div class="skill-title">${msg.skill.skillName}</div>
                <div class="progress">
                    <div class="progress-bar" style="width: ${msg.skill.skillLevel}%"></div>
                </div>
            </div>
            <div class="skill-level-text">${msg.skill.skillLevel}%</div>
        `;

        skillContainer.appendChild(div);
    }
}

//update
channel2.onmessage = function(e) {
    const msg = e.data;

    if (msg.action === 'update' && msg.skill) {

        const container = document.getElementById('skillsContainer');
        if (!container) return;

        const card = container.querySelector(`.skill-item[data-id="${msg.skill.id}"]`);

        if (!card) {
            console.log("CARD NOT FOUND FOR ID:", msg.skill.id);
            return;
        }

        card.querySelector('.skill-title').textContent = msg.skill.skillName;
        card.querySelector('.skill-level-text').textContent = msg.skill.skillLevel + '%';
        card.querySelector('.progress-bar').style.width = msg.skill.skillLevel + '%';
    }
}

// ✅ DELETE
channel3.onmessage = function(e) {
    const msg = e.data;

    if (msg.action === 'delete' && msg.id) {
    
        const container = document.getElementById('skillsContainer');
        if (container) {
            const card = container.querySelector(`.skill-item[data-id="${msg.id}"]`);
            if (card) {
                card.remove();
            }
        }
        
        const row = document.querySelector(`tr[data-id="${msg.id}"]`);
        if (row) {
            row.remove();
        }
    }
}