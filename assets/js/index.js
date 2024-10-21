function confirmDelete(id , bookName) {
    document.getElementById('id_book').value = id;
    document.getElementById('bookId').innerText = id;
    document.getElementById('bookname').innerText = bookName;
    var form = document.getElementById('confirmDeleteModal');
    var id = document.getElementById('id_book').value;
    form.action = 'index.php?action=confirmationdeleteBook&id='+ id;
}

function toggleReadStatus(checkbox) {
    const bookId = checkbox.getAttribute('data-id');
    const isRead = checkbox.checked ? 1 : 0; // Si está chequeado, 1 (leído), si no, 0 (no leído)

    const formData = new FormData();
    formData.append('id', bookId);
    formData.append('is_read', isRead); // Enviar el estado de lectura
    formData.append('action', 'updateReadStatus');

    // Realizar la solicitud fetch y capturar la respuesta
    fetch('index.php?action=updateReadStatus', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json()) // Procesar la respuesta JSON
    .then(data => {
        if (data.success) {
            alert(data.message); // Mostrar el mensaje de éxito
            window.location.reload();
        } else {
            alert('Error: ' + data.message); // Mostrar el mensaje de error
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        alert('Error en la solicitud.'); // Mostrar un mensaje de error en caso de fallo
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('UpdateBookModal');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que activó el modal
        const bookId = button.getAttribute('data-id'); // Obtener el ID del libro desde el atributo data-id

        const idInput = modal.querySelector('#id');
        idInput.value = bookId;

        console.log("El modal se ha mostrado");
        console.log("ID del libro:", bookId); // Asegúrate de que se está obteniendo el ID correcto

        const bookName = modal.querySelector('#bookName');
        const description = modal.querySelector('#exampleFormControlTextarea1');
        const price = modal.querySelector('#price');
        const quantity = modal.querySelector('#quantity');
        const publicationDate = modal.querySelector('#publicationDate');
        const imagePreview = modal.querySelector('#vista-previa-update');
        const inputImage = modal.querySelector('#inputimagenguardada');
        
        const lenguageSelect = modal.querySelector('#lenguageSelect');
        const genreSelect = modal.querySelector('#genreSelect');
        const authorSelect = modal.querySelector('#authorSelect');
        

        const formData = new FormData();
        formData.append('id', bookId); // Envía el ID dinámicamente
        formData.append('action', 'handleRequest'); // Acción que quieres manejar

        fetch('index.php?action=handleRequest', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            console.log('Respuesta cruda:', response);
            return response.json();
        })
        .then(data => {
            console.log('Datos procesados:', data);

            if (data.success) {
                // Asigna los valores a los elementos del DOM
                idInput.value = data.data.id_book; // Asegúrate de que accedes correctamente a los datos
                bookName.value = data.data.name_book;
                description.value = data.data.description_book;
                price.value = data.data.price_book;
                quantity.value = data.data.amount_book;
                publicationDate.value = data.data.year_book;
                imagePreview.src = data.data.imagen_book;
                inputImage.value= data.data.imagen_book;
                authorSelect.value = data.data.id_author; // Se selecciona la opción por valor
                lenguageSelect.value = data.data.id_lenguage; // Se selecciona la opción por valor
                genreSelect.value = data.data.id_gener;
                inputImage.required = false;

            } else {
                console.error('Error en la solicitud: ', data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud fetch:', error);
        });
    });
});


function mostrarVistaPrevia() {
    const inputImagen = document.getElementById('Inputimagen');
    const vistaPrevia = document.getElementById('vista-previa');

    const archivo = inputImagen.files[0];
    if (archivo) {
        const lector = new FileReader();

        lector.onload = function(e) {
            vistaPrevia.src = e.target.result;
        }

        lector.readAsDataURL(archivo);
    }
}
function mostrarVistaPreviaUpdate() {
    const inputImagen = document.getElementById('InputimagenUpdate');
    const vistaPrevia = document.getElementById('vista-previa-update');

    const archivo = inputImagen.files[0];
    if (archivo) {
        const lector = new FileReader();

        lector.onload = function(e) {
            vistaPrevia.src = e.target.result;
        }

        lector.readAsDataURL(archivo);
    }
}


document.addEventListener('DOMContentLoaded', function() {
    var sidebar = document.getElementById('sidebar');
    var sidebarCollapse = document.getElementById('sidebarCollapse');

    sidebarCollapse.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    // Cierra el sidebar en dispositivos móviles cuando se hace clic fuera de él
    document.addEventListener('click', function(event) {
        var isClickInsideNavbar = event.target.closest('.navbar');
        var isClickInsideSidebar = event.target.closest('#sidebar');
        if (!isClickInsideNavbar && !isClickInsideSidebar && window.innerWidth <= 768) {
            sidebar.classList.remove('active');
        }
    });

    // Ajusta el sidebar al cambiar el tamaño de la ventana
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
        }
    });

    
});



