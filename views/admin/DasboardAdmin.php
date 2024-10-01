<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-white">
            <div class="sidebar-header">
                <div id="img-user" class="Conthcc" >
                    <div id="logo" class="Conthcl">
                        <img src="assets/img/logo.png" alt="usuario" style="max-width: 100%; max-width: 100%; background: transparent;">
                    </div> 
                    <div id="name-user" class="Contvcl">
                    <h6><?php echo htmlspecialchars($_SESSION['user_name']); ?></h6>
                        <h6>Admin</h6>
                    </div>
                </div> 
            </div>
            
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#" class=" text-decoration-none">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="text-decoration-none">
                        <i class="bi bi-book me-2"></i> Insertar libro
                    </a>
                </li>
                <li>
                    <a href="#" class=" text-decoration-none">
                        <i class="bi bi-gear me-2"></i> Configuración
                    </a>
                </li>
                <li>
                    <a href="logout.php" class=" text-decoration-none">
                        <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="bi bi-list"></i>
                        <span class="visually-hidden">Toggle Sidebar</span>
                    </button>
                    <span class="navbar-brand mb-0 h1">Dashboard Administrador</span>
                </div>
            </nav>
            <div class="contenido-superior">
                <div class="container-fluid">
                    <div id="cards">
                        <div class="menu-card">
                            <div class="icono">
                                <img src="assets/img/users.png" alt="usuario">
                            </div>
                            <div class="contenido">
                                <h3 style="color: black;">Usuarios</h3>
                                <h3 class="info-cantidad">0</h3>
                            </div>
                        </div>
                        <div class="menu-card">
                            <div class="icono">
                                <img src="assets/img/books.png" alt="libro">
                            </div>
                            <div class="contenido">
                                <h3 style="color: black;">Libros</h3>
                                <h3 class="info-cantidad"><?php echo $bookCount; ?></h3>
                            </div>
                        </div>
                        <div class="menu-card">
                            <div class="icono">
                                <img src="assets/img/pedidos.png" alt="reportes">
                            </div>
                            <div class="contenido">
                                <h3 style="color: black;">Reportes</h3>
                                <h3 class="info-cantidad">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contenido-inferior">
                <div class="container-fluid">
                    <div class="book-container">
                        <?php foreach ($books as $book): ?>
                        <div class="book-card">
                            <img src="<?php echo htmlspecialchars($book['imagen_book']); ?>" alt="<?php echo htmlspecialchars($book['name_book']); ?>" class="book-cover">
                            <div class="book-overlay">
                                <h3 class="book-title"><?php echo htmlspecialchars($book['name_book']); ?></h3>
                                <p class="book-type"><?php echo htmlspecialchars($book['name_type']); ?></p>
                                <div class="book-actions">
                                    <a href="index.php?action=updateBook&id=<?php echo $book['id_book']; ?>" class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Actualizar
                                    </a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="confirmDelete(<?php echo $book['id_book']; ?>, '<?php echo addslashes($book['name_book']); ?>')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que quieres eliminar este libro?</p>
                    <p>ID del libro: <strong id="bookId"></strong></p>
                    <p>Nombre del libro: <strong id="bookname"></strong></p>
                </div>
                <div class="modal-footer">
                    <form action="index.php?action=confirmationdeleteBook&id=" method="post">
                        <input type="hidden" name="id" id="id_book" value="">
                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/index.js" ></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>