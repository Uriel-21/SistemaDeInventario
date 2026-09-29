const menuToggle = document.querySelector("#menu-toggle");
const menuOpciones = document.querySelector("#menu-opciones");
const menuFondo = document.querySelector("#menu-fondo");
const menuCerrar = document.querySelector("#menu-cerrar");

function abrirMenu() {
  menuOpciones.classList.remove("invisible", "translate-x-full");
  menuOpciones.setAttribute("aria-hidden", "false");
  menuFondo.hidden = false;
  menuToggle.setAttribute("aria-expanded", "true");
  menuToggle.setAttribute("aria-label", "Cerrar menú");
  menuCerrar.focus();
}

function cerrarMenu() {
  menuOpciones.classList.add("translate-x-full");
  menuOpciones.setAttribute("aria-hidden", "true");
  menuFondo.hidden = true;
  menuToggle.setAttribute("aria-expanded", "false");
  menuToggle.setAttribute("aria-label", "Abrir menú");
}

menuToggle.addEventListener("click", abrirMenu);
menuCerrar.addEventListener("click", cerrarMenu);
menuFondo.addEventListener("click", cerrarMenu);

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") cerrarMenu();
});