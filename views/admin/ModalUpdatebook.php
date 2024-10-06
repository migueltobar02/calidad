<!-- Modal para insertar libro -->
<div class="modal fade" id="UpdateBookModal" tabindex="-1" aria-labelledby="UpdateBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UpdateBookModalLabel">Actualizar Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del formulario para insertar libro -->
                <form id="udpateBookForm" action="index.php?action=UpdateBook&id=" method="post"  enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="bookName" class="form-label">Nombre del Libro</label>
                        <input type="text" class="form-control" id="bookName" name="bookName" required>
                    </div>
                    <div class="row mb-12" style="justify-content: center;">
                        <div class="col-lg-5 col-md-12" style="height: 149.19px; width: 160px; max-width: 187px; max-height: 149.19px; overflow: hidden; margin-right: 10px;  display: flex; align-items: center; justify-content: center;">
                            <img style="width: auto; height: auto; max-height: 149.19px; max-width: 187px; align-items: center;" class="modal-img" id="vista-previa-update" alt="" src="">
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3 mt-3">
                            <label for="Inputimagen" class="form-label">Subir imagen</label>
                            <input type="file" id="InputimagenUpdate" name="InputimagenUpdate" accept="image/*" onchange="mostrarVistaPreviaUpdate()" >
                            <input type="hidden" id="inputimagenguardada" name="inputimagenguardada" value=''>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-12">
                            <label for="price" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="price" name="price"  placeholder="Precio" required>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <label for="quantity" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Cantidad" required>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <label for="publicationDate" class="form-label">Fecha de publicación</label>
                            <input type="date" class="form-control" id="publicationDate" name="publicationDate" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" id="description" required></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="lenguageSelect">lenguaje</label>
                        <select class="form-select" id="lenguageSelect" name="lenguageSelect" required>
                            <option value="" selected>Choose...</option>
                            <?php foreach ($lenguajes as $lenguaje): ?>
                                <option value="<?= $lenguaje['id_lenguage'] ?>"><?= $lenguaje['name_lenguage'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="genreSelect">Genero</label>
                        <select class="form-select" id="genreSelect" name="genreSelect" required>
                            <option value="" selected>Choose...</option>
                            <?php foreach ($generos as $genero): ?>
                                <option value="<?= $genero['id_gener'] ?>"><?= $genero['name_gener'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="authorSelect">Autor</label>
                        <select class="form-select"  id="authorSelect" name="authorSelect" required>
                            <option value="" selected>Choose...</option >
                            <?php foreach ($autors  as $autor ): ?>
                                <option value="<?= $autor['id_author'] ?>"><?= $autor['name_author'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="id" name="id" value=''>
                    <input type="hidden" id="state_book" name="state_book" value="2">
                    <input type="hidden" id="rate_book" name="rate_book" value="0">
                    <!-- Otros campos del formulario -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="udpateBookForm" class="btn btn-primary">Actualizar libro</button>
            </div>
        </div>
    </div>
</div>
