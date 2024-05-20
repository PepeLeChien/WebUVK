const formulario = document.getElementById('formulario-inicio-sesion');

formulario.addEventListener('submit', (event) => {
  event.preventDefault();

  const nombreUsuario = document.getElementById('nombre-usuario').value;
  const contrasena = document.getElementById('contrasena').value;

  // Validar los datos de inicio de sesión
  if (nombreUsuario === 'admin' && contrasena === '12345') {
    // Inicio de sesión exitoso
    alert('¡Inicio de sesión exitoso!');
    // Redirigir a la página principal o realizar otra acción
  } else {
    // Inicio de sesión fallido
    alert('¡Nombre de usuario o contraseña incorrectos!');
  }
});