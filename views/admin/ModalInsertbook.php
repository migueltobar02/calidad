<!-- Modal para insertar libro -->
<div class="modal fade" id="insertBookModal" tabindex="-1" aria-labelledby="insertBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertBookModalLabel">Insertar Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del formulario para insertar libro -->
                <form id="insertBookForm">
                    <div class="mb-3">
                        <label for="bookName" class="form-label">Nombre del Libro</label>
                        <input type="text" class="form-control" id="bookName" required>
                    </div>
                    <div class="row mb-12" style="justify-content: center;">
                        <div class="col-lg-5 col-md-12" style="height: 149.19px; width: 160px; max-width: 187px; max-height: 149.19px; overflow: hidden; margin-right: 10px;  display: flex; align-items: center; justify-content: center;">
                            <img style="width: auto; height: auto; max-height: 149.19px; max-width: 187px; align-items: center;" class="modal-img" id="vista-previa" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3 mt-3">
                            <label for="Inputimagen" class="form-label">Subir imagen</label>
                            <input type="file" id="Inputimagen" name="Inputimagen" accept="image/*" onchange="mostrarVistaPrevia()" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-12">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" placeholder="Precio">
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Cantidad">
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for="publicationDate" class="form-label">Fecha de publicación</label>
                            <input type="date" class="form-control" id="publicationDate">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">lenguaje</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Genero</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Autor</label>
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <!-- Otros campos del formulario -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="insertBookForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>