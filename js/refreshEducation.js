function refreshEducation() {
    fetch('admin/actions/getEducation.php')
        .then(res => res.json())
        .then(data => {
            if (data.status !== 'success') return;

            const container = document.getElementById('.edu');
            if (!container) return;

            container.innerHTML = ''; // clear current cards
            data.data.forEach(edu => {
                const card = document.createElement('div');
                card.className = 'edu-card';
                card.dataset.id = edu.id;
                card.innerHTML = `
                    <h4>${edu.institution}</h4>
                    <p>${edu.degree}</p>
                    <span>${edu.year}</span>
                `;
                container.appendChild(card);
            });
        })
        .catch(err => console.error('Fetch education error:', err));
}

// initial load
refreshEducation();
// poll every 2–3 seconds
setInterval(refreshEducation, 3000);