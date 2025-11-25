const projectChannel1 = new BroadcastChannel('project_add');
const projectChannel2 = new BroadcastChannel('project_delete');

projectChannel1.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === 'add' && msg.project) {

        const projectsGrid = document.querySelector('.projectsGrid');
        if (!projectsGrid) return;

        // Prevent duplicate rendering
        if (document.querySelector(`.projectCard[data-id='${msg.project.id}']`)) {
            return;
        }

        const projectCard = document.createElement('div');
        projectCard.className = 'projectCard';
        projectCard.setAttribute('data-id', msg.project.id);

        projectCard.innerHTML = `
            <div class="project-image-wrapper">
                <img src="${msg.project.image}" alt="${msg.project.projectName} Screenshot">
                <div class="overlay"></div>
            </div>
            <div class="project-content">
                <h2>${msg.project.projectName}</h2>
                <p>${msg.project.description}</p>
                <div class="buttons">
                    <a href="${msg.project.liveDemo}" class="btn demo" target="_blank">
                        <i class="fas fa-eye"></i> Live Demo
                    </a>
                    <a href="${msg.project.sourceCode}" class="btn code" target="_blank">
                        <i class="fas fa-code"></i> View Code
                    </a>
                </div>
            </div>
        `;

        projectsGrid.appendChild(projectCard);
    }
};

projectChannel2.onmessage = function (e) {
    const msg = e.data;

    if (msg.action === "delete") {
        const card = document.querySelector(`.projectCard[data-id='${msg.id}']`);
        if (card) card.remove();
    }
};