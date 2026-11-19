<?php
require "../models/database/historias_db_interface.php";
require "../models/database/historias_db.php";
require "../models/entities/sprint.php";
require "../models/mappers/sprint_mappers.php";
require "../models/repositories/sprints_respository/sprints_respository_interface.php";
require "../models/repositories/sprints_respository/sprints_respository.php";
require "../models/config/models_config.php";

require "../controllers/mappers/sprints_mapper_controller.php";
require "../controllers/sprints/sprints_controller_interface.php";
require "../controllers/sprints/sprints_controller.php";
require "../controllers/config/controllers_config.php";

use app\controllers\config\ControllersConfig;

$titulo = "Crear sprint";
$action = "operaciones/registrar_sprint.php";
$id = 0;
$nombre = "";
$fecha_inicio = "";
$fecha_fin = "";

if (!empty($_GET['id'])) {
    $titulo = "Modificar sprint";
    $action = "operaciones/modificar_sprint.php";
    $id = $_GET['id'];
    $controller = ControllersConfig::get_sprints_controller();
    $sprint = $controller->get_sprint($id);
    $nombre = $sprint->get_nombre();
    $fecha_inicio = $sprint->get_fecha_inicio();
    $fecha_fin = $sprint->get_fecha_fin();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <h1><?php echo $titulo; ?></h1>
    <br>
    <a href="inicio.php">Volver</a>
    <br>
    <form action="<?php echo $action; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div>
            <label for="nombre">Nombre del sprint:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>
        <div>
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" required>
        </div>
        <div>
            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $fecha_fin; ?>" required>
        </div>
        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>

</html>
