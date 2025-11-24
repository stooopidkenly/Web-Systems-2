 function openCert(src) {
            document.getElementById("certModalImg").src = src;
            document.getElementById("certModal").style.display = "flex";
        }

        function closeCert() {
            document.getElementById("certModal").style.display = "none";
        }