function confirmDelete(id , bookName) {
    document.getElementById('id_book').value = id;
    document.getElementById('bookId').innerText = id;
    document.getElementById('bookname').innerText = bookName;
    var form = document.getElementById('confirmDeleteModal');
    var id = document.getElementById('id_book').value;
    form.action = 'index.php?action=confirmationdeleteBook&id='+ id;
}

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



