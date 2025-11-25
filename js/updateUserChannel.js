const channel = new BroadcastChannel("user_updates");

channel.onmessage = function (e) {
    const user = e.data;

    document.getElementById("name").textContent = user.name;
    document.getElementById("email").textContent = user.email;
    document.getElementById("address").textContent = user.address;
    document.getElementById("phoneNum").textContent = user.phoneNum;
    document.getElementById("description").textContent = user.description;

    const photoEl = document.getElementById("profile");
    if (photoEl && user.photo) {
        photoEl.src = user.photo + "?t=" + Date.now();
    }
};