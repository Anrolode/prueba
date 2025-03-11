document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const correo = document.getElementById("correo").value;
    const clave = document.getElementById("clave").value;

    fetch("../backend/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `correo=${correo}&clave=${clave}`
    })
    .then(response => response.text())
    .then(data => {
        if (data === "admin") {
            window.location.href = "dashboard_admin.php";
        } else if (data === "usuario") {
            window.location.href = "dashboard.php";
        } else {
            alert("Error en las credenciales");
        }
    });
});