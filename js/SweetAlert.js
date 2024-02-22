import Swal from 'sweetalert2'

// or via CommonJS
const Swal = require('sweetalert2')

function mostrarAlerta() {
    Swal.fire({
        title: '¡Hola mundo!',
        text: '¡Este es un mensaje de alerta!',
        icon: 'success',
        confirmButtonText: '¡Entendido!'
    });
}