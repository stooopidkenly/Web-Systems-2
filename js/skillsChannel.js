const channel1 = new BroadcastChannel('skills');
const channel2 = new BroadcastChannel('updatedSkills');

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

// UPDATE
channel2.onmessage = function(e) {
    const msg = e.data;

    if (msg.action === 'update' && msg.skill) {
        const updatedSkill = msg.skill;
        const container = document.getElementById('skillsContainer');
        if (!container) return;

        const skillCards = container.querySelectorAll('.skill-item');

        skillCards.forEach(card => {
            const skillTitleEl = card.querySelector('.skill-title');

            if (skillTitleEl.textContent === updatedSkill.skillName) {
                card.querySelector('.skill-level-text').textContent = updatedSkill.skillLevel + '%';
                card.querySelector('.progress-bar').style.width = updatedSkill.skillLevel + '%';
            }
        });
    }
}
