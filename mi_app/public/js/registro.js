document.getElementById("registroForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre").value;
    const correo = document.getElementById("correo").value;
    const clave = document.getElementById("clave").value;
    const rol = document.getElementById("rol").value;

    fetch("../backend/registro.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `nombre=${nombre}&correo=${correo}&clave=${clave}&rol=${rol}`
    })
    .then(response => response.text())
    .then(data => alert(data));
});