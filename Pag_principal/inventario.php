<?php
include("sesion.php");
// Obtener el nombre de usuario de la sesión
$nombre = $_SESSION['sesion_email'];

// Obtener la información del usuario de la base de datos
$conectar = conn();
$nombre = mysqli_real_escape_string($conectar, $nombre);

$sql = "SELECT * FROM registro WHERE Nombre = '$nombre'";
$resul = mysqli_query($conectar, $sql) or trigger_error("query failed SQL-ERROR:" . mysqli_error($conectar), E_USER_ERROR);
$row = mysqli_fetch_array($resul);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gabo Café</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../public/template/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../public/template/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <style>
        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }

        #footer1 {
            position: auto;
            bottom: 0px;
            padding-bottom: 0px;
        }

        .content-container {
            display: flex;
            justify-content: space-between;
        }

        .form-container {
            width: 45%;
        }

        .table-container {
            width: 50%;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="pag_principal.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="registro_ventas.php" class="nav-link">Registro de ventas</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="registro_compras.php" class="nav-link">Registro de compras</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="inventario.php" class="nav-link">Inventario</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="../public/template/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../public/template/AdminLTE-3.2.0/dist/img/hunter.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo htmlspecialchars($row['Nombre'] . ' ' . $row['Apellido']); ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Ventas/Compras
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="registro_ventas.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registro de ventas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="registro_compras.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registro de compras</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="inventario.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inventario</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="../app/controladores/login/cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Bienvenido!</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4">
                <div class="content-container">
                    <div class="form-container">
                        <!--Formulario de Inventario-->
                        <form class="form-container p-3" method="POST" action="registro_compras.php">
                            <h3 class="text-center text-secondary">Agregar Producto</h3>
                            <div class="mb-2">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion" value="<?php echo $_GET['edit_descripcion'] ?? ''; ?>"required>
                            </div>
                            <div class="mb-2">
                                <label for="cliente" class="form-label">Cliente</label>
                                <input type="text" class="form-control form-control-sm" name="cliente" id="cliente" value="<?php echo $_GET['edit_cliente'] ?? ''; ?>"required>
                            </div>
                            <div class="mb-2">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control form-control-sm" name="fecha" id="fecha" value="<?php echo $_GET['edit_fecha'] ?? ''; ?>"required>
                            </div>
                            <div class="mb-2">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="text" class="form-control form-control-sm" name="cantidad" id="cantidad" value="<?php echo $_GET['edit_cantidad'] ?? ''; ?>"required>
                            </div>
                            <div class="mb-2">
                                <label for="precio_venta" class="form-label">Precio de Venta</label>
                                <input type="text" class="form-control form-control-sm" name="precio_venta" id="precio_venta" value="<?php echo $_GET['edit_precio_venta'] ?? ''; ?>"required>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?php echo $_GET['edit_id'] ?? ''; ?>">
                                <input type="submit" class="btn btn-primary" name="btnregistrar" value="Registrar venta">
                                <input type="submit" class="btn btn-warning" name="btneditar" value="Actualizar" <?php echo isset($_GET['edit_id']) ? '' : 'disabled'; ?>>
                            </div>
                        </form>
                    </div>

                    <!-- Filtro de búsqueda y Tabla de Registros de inventario -->
                    <div class="table-container col-md-8">
                        <div class="mb-3">
                            <input type="text" id="search" class="form-control" placeholder="Buscar por proveedor o descripción">
                        </div>
                        <table class="table">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio de Venta</th>
                            </tr>
                            </thead>
                            <tbody id="table-body">
                                <?php
                                $sql = "SELECT id, descripcion, cliente, fecha, cantidad, precio_venta FROM inventario";
                                $result = $conectar->query($sql);

                                if ($result) {
                                    while ($datos = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($datos['id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($datos['descripcion']) . "</td>";
                                        echo "<td>" . htmlspecialchars($datos['cliente']) . "</td>";
                                        echo "<td>" . htmlspecialchars($datos['fecha']) . "</td>";
                                        echo "<td>" . htmlspecialchars($datos['cantidad']) . "</td>";
                                        echo "<td>" . htmlspecialchars($datos['precio_venta']) . "</td>";
                                        echo "<td>";
                                        echo '<a href="inventario.php?edit_id=' . $datos['id'] . '&edit_descripcion=' . ($datos['descripcion']) . '&edit_cliente=' . $datos['cliente'] . '&edit_fecha=' . $datos['fecha'] . '&edit_cantidad=' . $datos['cantidad'] . 'edit_precio_venta=' . $datos['precio_venta'] . '" class="btn btn-small btn-warning">Editar</a>';
                                        echo ' <a href="inventario.php?delete_id=' . $datos['id'] . '" class="btn btn-small btn-danger">Eliminar</a>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer" id="footer1">
            <strong>Gabo Café</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
    </div>

    <script src="../public/template/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="../public/template/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../public/template/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <script>
        //logica del buscador
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#table-body tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>

<?php
// Lógica para manejar el registro y edición de inventario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnregistrar'])) {
        // Recoger datos del formulario
        $descripcion = mysqli_real_escape_string($conectar, $_POST['descripcion']);
        $cliente = mysqli_real_escape_string($conectar, $_POST['cliente']);
        $fecha = mysqli_real_escape_string($conectar, $_POST['fecha']);
        $cantidad = mysqli_real_escape_string($conectar, $_POST['cantidad']);
        $precio_venta = mysqli_real_escape_string($conectar, $_POST['precio_venta']);

        // Inserción de datos en la base de datos
        $sql = "INSERT INTO inventario (descripcion, cliente, fecha, cantidad, precio_venta) VALUES ('$descripcion', '$cliente', '$fecha', '$cantidad', '$precio_venta')";
        if (mysqli_query($conectar, $sql)) {
            echo '<script>window.location="inventario.php?status=success"</script>';
        } else {
            die("Error: " . mysqli_error($conectar));
        }
        exit();
    }

    if (isset($_POST['btneditar'])) {
        $id = mysqli_real_escape_string($conectar, $_POST['id']);
        $descripcion = mysqli_real_escape_string($conectar, $_POST['descripcion']);
        $cliente = mysqli_real_escape_string($conectar, $_POST['cliente']);
        $fecha = mysqli_real_escape_string($conectar, $_POST['fecha']);
        $cantidad = mysqli_real_escape_string($conectar, $_POST['cantidad']);
        $precio_venta = mysqli_real_escape_string($conectar, $_POST['precio_venta']);

        // Actualización de datos en la base de datos
        $sql = "UPDATE inventario SET descripcion='$descripcion', cliente='$cliente', fecha='$fecha', cantidad='$cantidad', precio_venta='$precio_venta' WHERE id='$id'";
        if (mysqli_query($conectar, $sql)) {
            echo '<script>window.location="inventario.php?status=updated"</script>';
        } else {
            die("Error: " . mysqli_error($conectar));
        }
        exit();
    }
}
// Lógica para manejar la eliminación
if (isset($_GET['delete_id'])) {
    $id = mysqli_real_escape_string($conectar, $_GET['delete_id']);
    $sql = "DELETE FROM inventario WHERE id='$id'";
    mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    echo '<script>window.location="inventario.php?status=deleted"</script>';
    exit();
}
?>