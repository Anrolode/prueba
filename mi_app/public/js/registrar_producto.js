document.getElementById("registroProductoForm").addEventListener("submit", function(e) {
    e.preventDefault(); // Evita que el formulario se recargue

    // Capturar valores del formulario
    const nombre = document.getElementById("nombre").value.trim();
    const descripcion = document.getElementById("descripcion").value.trim();
    const precio = document.getElementById("precio").value.trim();
    const categoria = document.getElementById("categoria").value.trim();

    // Validación básica (evita enviar datos vacíos)
    if (!nombre || !descripcion || !precio || !categoria) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    // Validación de precio (debe ser un número positivo)
    if (isNaN(precio) || parseFloat(precio) <= 0) {
        alert("El precio debe ser un número válido mayor a 0.");
        return;
    }

    // Enviar los datos al backend con fetch
    fetch("../backend/registrar_producto.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `producto=${encodeURIComponent(nombre)}&descripcion=${encodeURIComponent(descripcion)}&precio=${encodeURIComponent(precio)}&categoria=${encodeURIComponent(categoria)}`
    })
    .then(response => response.text())
    .then(data => alert(data)) // Muestra la respuesta del backend
    .catch(error => alert("Error en el registro: " + error));
});