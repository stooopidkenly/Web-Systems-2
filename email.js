document.querySelector(".contactForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = this;
    const formMessages = document.getElementById("form-messages");

    let formData = new FormData(form);

    fetch("sendEmail.php", {
        method: "POST",
        body: formData
    })
        .then(async (res) => {
            const text = await res.text();
            console.log("RAW:", text); // para makita natin
            return JSON.parse(text);
        })
        .then(data => {
            console.log("PARSED:", data);

            if (data.status === "success") {
                formMessages.textContent = "Message sent successfully!";
                formMessages.style.color = "green";
                form.reset();
            } else {
                formMessages.textContent = data.message;
                formMessages.style.color = "red";
            }
        })
        .catch(err => {
            console.log(err);
            formMessages.textContent = "Something went wrong.";
            formMessages.style.color = "red";
        })
});

