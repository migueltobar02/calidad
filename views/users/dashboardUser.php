<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de uusario</title>
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
                        <h6>User</h6>
                    </div>
                </div> 
            </div>
            
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="?action=user" class="text-decoration-none">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                <a href="#" class="text-decoration-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                    <i class="bi bi-book me-2"></i> Libros leídos
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
            <nav class=" navbar  bg-light ">

                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="bi bi-list"></i>
                        <span class="visually-hidden">Toggle Sidebar</span>
                    </button>
                    <span class="navbar-brand mb-0 h1">Bienvenido a la biblioteca virtual</span>
                    <form class="d-flex" role="search" method="GET" action="">
                        <input type="hidden" name="action" value="user">
                        <input class="form-control me-2" type="search" name="query" placeholder="Buscar libros o autores" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Buscar</button>
                    </form>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">libros leidos</h5> 
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                        <div class="container-fluid">
                            <div class="book-container">
                                <?php foreach ($readBooks as $readBook): ?>
                                <div class="book-card">
                                    <img src="<?php echo htmlspecialchars($readBook['imagen_book']); ?>" alt="<?php echo htmlspecialchars($readBook['name_book']); ?>" class="book-cover">
                                    <div class="book-overlay">
                                        <h3 class="book-title"><?php echo htmlspecialchars($readBook['name_book']); ?></h3>
                                        <p><i class="bi bi-person"> Autores: </i> <?php echo htmlspecialchars($readBook['name_author']); ?></p>
                                        <!-- Fecha con ícono de ojo -->
                                        <p><i class="bi bi-eye"> fecha </i> <?php echo htmlspecialchars($readBook['date_readbook']); ?></p>
                                        <!-- Leído con ícono de check -->
                                        <p><i class="bi bi-check-circle"></i> leido</p>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                </div>
            </nav>
            <div class="contenido-inferior-user">
                <div class="container-fluid">
                    <div class="book-container">
                        <?php foreach ($books as $book): ?>
                        <div class="book-card">
                            <img src="<?php echo htmlspecialchars($book['imagen_book']); ?>" alt="<?php echo htmlspecialchars($book['name_book']); ?>" class="book-cover">
                            <div class="book-overlay">
                                <h3 class="book-title"><?php echo htmlspecialchars($book['name_book']); ?></h3>
    
                                <!-- <div class="book-actions">
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="confirmDelete(<?php echo $book['id_book']; ?>, '<?php echo addslashes($book['name_book']); ?>')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </div> -->
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/index.js" ></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>