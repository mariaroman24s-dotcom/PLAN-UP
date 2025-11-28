// En la parte del fetch del login - BUSCA ESTA SECCIÓN Y CÁMBIALA:

loginForm.addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(loginForm);

    fetch("../config/login.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        console.log("Respuesta del servidor:", data); // Para debug

        if (data.trim() === "success") {
            // ✅ RUTA ABSOLUTA CORREGIDA
            window.location.href = "/src/views/menu.php";
        } 
        else if (data.trim() === "faltan_datos") {
            alert("Por favor completa todos los campos.");
        }
        else if (data.trim() === "error_credenciales") {
            alert("Correo o contraseña incorrectos ✘");
        }
        else {
            alert("Error del servidor. Intenta nuevamente.");
        }
    })
    .catch(error => {
        console.error("Error en fetch:", error);
        alert("Error de conexión");
    });
});