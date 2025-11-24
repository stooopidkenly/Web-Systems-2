  //ADD EDUCATION INFORMATION
        document.getElementById('educationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch('actions/addEducation.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === "success") {
                        document.getElementById('educationForm').reset();
                        alert(data.message);
                        closeModal('modal-education');
                    } else {
                        alert("Education Information Added Successful");
                    }
                })
                .catch(err => console.error("AJAX ERROR: ", err));
        });

        //DELETE EDUCATION INFORMATION

        document.querySelectorAll('#eduTable .btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const modalRow = this.closest('tr');

                if (!confirm("Are you sure you want to delete this record?")) return;

                const formData = new FormData();
                formData.append('edu_id', id);

                fetch('actions/deleteEducation.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === "success") {
                            modalRow.remove(); // remove row from modal

                            // send a message to public page
                            const channel = new BroadcastChannel('portfolio_edu');
                            channel.postMessage({
                                action: 'delete',
                                id
                            });

                            alert(data.message);
                        } else {
                            alert("Error: " + data.message);
                        }
                    })
                    .catch(err => console.error("AJAX ERROR:", err));
            });
        });