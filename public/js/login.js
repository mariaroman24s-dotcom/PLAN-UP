/*************************************************
 * PRELOAD (opcional pero mejora velocidad)
 *************************************************/
const preloadImages = [
  "../../public/img/jenny_saludando.webp",
  "../../public/img/jenny_ojos_tapados.png",
  "../../public/img/jenny_un_ojo.png",
  "../../public/img/jenny_destapa_un_ojo.webp",
  "../../public/img/jenny_tapa_un_ojo.webp",
  "../../public/img/jenny_destapa_ojos_1.webp",
  "../../public/img/jenny_destapa_ojos_2.webp",
  "../../public/img/jenny_se_tapa_los_ojos.webp"
];
preloadImages.forEach(src => { const img = new Image(); img.src = src; });

/*************************************************
 * VARIABLES
 *************************************************/
const container     = document.querySelector('.container');
const registerBtn   = document.querySelector('.register-btn');
const loginBtn      = document.querySelector('.login-btn');

// OJO: solo hay un icono con id="bx-hide", es el del login
const toggleEyes = document.querySelectorAll('.toggle-eye');

// Todos los inputs de contraseña (login + registro)
const passwordInputs = document.querySelectorAll('input[type="password"]');

// JENNYS
const jennyLogin    = document.getElementById('jennyLogin');
const jennyRegister = document.getElementById('jennyRegister');

// Estado
let activeJenny    = 'login';   // 'login' | 'register'
let jennyState     = 'normal';  // normal | ojos_cubiertos | un_ojo | animando
let jennyTimeout   = null;
let passwordVisible = false;

/*************************************************
 * ESTADO INICIAL DE LAS JENNYS
 *************************************************/
if (jennyLogin) jennyLogin.style.opacity = '1';
if (jennyRegister) jennyRegister.style.opacity = '0';

/*************************************************
 * FUNCIONES AUXILIARES
 *************************************************/
function getCurrentJenny() {
  return activeJenny === 'login' ? jennyLogin : jennyRegister;
}

function playJenny(gifSrc, finalSrc, newState, duration = 900) {
  const bot = getCurrentJenny();
  if (!bot) return;

  clearTimeout(jennyTimeout);

  bot.src = gifSrc;
  jennyState = 'animando';

  jennyTimeout = setTimeout(() => {
    bot.src = finalSrc;
    jennyState = newState;
  }, duration);
}

/*************************************************
 * CLICK EN CUALQUIER OJO (login + registro)
 *************************************************/
toggleEyes.forEach(eye => {
    eye.addEventListener("click", () => {
        const input = eye.parentElement.querySelector("input");
        const isPassword = input.type === "password";

        input.type = isPassword ? "text" : "password";
        passwordVisible = isPassword;

        eye.classList.toggle("bx-hide", !passwordVisible);
        eye.classList.toggle("bx-show", passwordVisible);

        if (passwordVisible) {
            playJenny("../../public/img/jenny_destapa_un_ojo.webp", "../../public/img/jenny_un_ojo.png", "un_ojo", 700);
        } else {
            playJenny("../../public/img/jenny_tapa_un_ojo.webp", "../../public/img/jenny_ojos_tapados.png", "ojos_cubiertos", 700);
        }
    });
});

/*************************************************
 * FOCUS / BLUR EN TODOS LOS INPUTS PASSWORD
 *************************************************/
passwordInputs.forEach(input => {
  input.addEventListener('focus', () => {
    if (!passwordVisible && jennyState !== 'ojos_cubiertos') {
      playJenny(
        "../../public/img/jenny_se_tapa_los_ojos.webp",
        "../../public/img/jenny_ojos_tapados.png",
        "ojos_cubiertos",
        700
      );
    }
  });

  input.addEventListener('blur', () => {
    if (passwordVisible) {
      playJenny(
        "../../public/img/jenny_destapa_ojos_2.webp",
        "../../public/img/jenny_saludando.webp",
        "normal",
        800
      );
    } else if (jennyState === 'un_ojo') {
      playJenny(
        "../../public/img/jenny_tapa_un_ojo.webp",
        "../../public/img/jenny_ojos_tapados.png",
        "ojos_cubiertos",
        700
      );
    } else if (jennyState === 'ojos_cubiertos') {
      playJenny(
        "../../public/img/jenny_destapa_ojos_1.webp",
        "../../public/img/jenny_saludando.webp",
        "normal",
        800
      );
    }
  });
});

/*************************************************
 * CAMBIO A REGISTRO - CORREGIDO
 *************************************************/
if (registerBtn) {
    registerBtn.addEventListener('click', () => {
        container.classList.add('active');
        activeJenny = 'register';
        if (jennyLogin) jennyLogin.style.opacity = '0';
        if (jennyRegister) jennyRegister.style.opacity = '1';
        playJenny("../../public/img/jenny_saludando.webp", "../../public/img/jenny_saludando.webp", "normal", 900);
    });
}

/*************************************************
 * CAMBIO A LOGIN - CORREGIDO
 *************************************************/
if (loginBtn) {
    loginBtn.addEventListener('click', () => {
        container.classList.remove('active');
        activeJenny = 'login';
        if (jennyRegister) jennyRegister.style.opacity = '0';
        if (jennyLogin) jennyLogin.style.opacity = '1';
        playJenny("../../public/img/jenny_saludando.webp", "../../public/img/jenny_saludando.webp", "normal", 900);
    });
}

/*************************************************
 * VALIDACIÓN DE REGISTRO - ERROR CRÍTICO CORREGIDO
 *************************************************/
const registerForm = document.querySelector(".form-box.register form");

if (registerForm) {
    registerForm.addEventListener("submit", function(e) {
        // ❌ ERROR ORIGINAL: "contraseña" vs "contrasena"
        // ✅ CORREGIDO: usar el nombre correcto del campo
        const pass = this.querySelector("input[name='contrasena']").value;
        const confirm = this.querySelector("input[name='confirmar']").value;

        if (pass !== confirm) {
            e.preventDefault();
            alert("Las contraseñas no coinciden ✘");
            return false;
        }
    });
}

/*************************************************
 * LOGIN - CORREGIDO
 *************************************************/
const loginForm = document.querySelector(".form-box.login form");

if (loginForm) {
    loginForm.addEventListener("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch("../config/login.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            console.log("Respuesta del servidor:", data);

            if (data.trim() === "success") {
                // ✅ CORREGIDO: Ruta absoluta
                window.location.href = "/src/views/menu.php";
            } 
            else if (data.trim() === "faltan_datos") {
                alert("Por favor completa todos los campos.");
            }
            else if (data.trim() === "error_credenciales") {
                alert("Correo o contraseña incorrectos ✘");
            }
            else {
                alert("Error del servidor: " + data);
            }
        })
        .catch(error => {
            console.error("Error en fetch:", error);
            alert("Error de conexión");
        });
    });
}