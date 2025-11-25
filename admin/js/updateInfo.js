// UPDATE USER INFORMATION
document.getElementById('updateForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    const photoInput = document.querySelector("input[name='photo']");
    if (!photoInput.files.length) {
        formData.delete("photo");
    }
    fetch('actions/updateUser.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if (data.status === "success") {
                document.querySelector('.user-name').textContent = data.updated.name;
                document.querySelector('.user-email').textContent = data.updated.email;
                document.querySelector('.user-address').textContent = data.updated.address;
                document.querySelector('.user-phone').textContent = data.updated.phoneNum;
                document.querySelector('.user-description').textContent = data.updated.description;

                // Force image reload with cache-busting
                if (document.querySelector('.user-photo')) {
                    document.querySelector('.user-photo').src = "../" + data.updated.photo + "?t=" + new Date().getTime();
                }

                closeModal('modal-user');

                // Optional: Show success message
                alert("Successfully updated!");
                const channel = new BroadcastChannel("user_updates");

                channel.postMessage({
                    name: document.querySelector("input[name='name']").value,
                    email: document.querySelector("input[name='email']").value,
                    address: document.querySelector("input[name='address']").value,
                    phoneNum: document.querySelector("input[name='phoneNum']").value,
                    description: document.querySelector("textarea[name='description']").value,
                    photo: document.getElementById("currentPhoto")?.src || ""
                });
            } else {
                alert("Error Updating User Information");
            }
        })
        .catch(err => console.error("AJAX ERROR:", err));
});