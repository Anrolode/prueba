document.getElementById("registroForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const nombre = document.getElementById("nombre").value.trim();
    const nombre_usuario = document.getElementById("nombre_usuario").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const clave = document.getElementById("clave").value.trim();
    const rol = document.getElementById("rol").value;
    const estado = document.getElementById("estado").value;

    // Validación básica en el frontend
    if (!nombre || !nombre_usuario || !correo || !clave || !rol || !estado) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    // Enviar los datos al backend
    fetch("../backend/registro.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `nombre=${encodeURIComponent(nombre)}&nombre_usuario=${encodeURIComponent(nombre_usuario)}&correo=${encodeURIComponent(correo)}&clave=${encodeURIComponent(clave)}&rol=${encodeURIComponent(rol)}&estado=${encodeURIComponent(estado)}`
    })
    .then(response => response.text())
    .then(data => alert(data))
    .catch(error => console.error("Error:", error));
});
