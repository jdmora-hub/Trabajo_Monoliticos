<?php
require "../models/database/historias_db_interface.php";
require "../models/database/historias_db.php";
require "../models/entities/sprint.php";
require "../models/entities/historia.php";
require "../models/mappers/sprint_mappers.php";
require "../models/mappers/historia_mappers.php";
require "../models/repositories/sprints_respository/sprints_respository_interface.php";
require "../models/repositories/sprints_respository/sprints_respository.php";
require "../models/repositories/historias_respository/historias_respository_interface.php";
require "../models/repositories/historias_respository/historias_respository.php";
require "../models/config/models_config.php";

require "../controllers/mappers/sprints_mapper_controller.php";
require "../controllers/mappers/historias_mapper_controller.php";
require "../controllers/sprints/sprints_controller_interface.php";
require "../controllers/sprints/sprints_controller.php";
require "../controllers/historias/historias_controller_interface.php";
require "../controllers/historias/historias_controller.php";
require "../controllers/config/controllers_config.php";

use app\controllers\config\ControllersConfig;

$titulo = "Crear historia de usuario";
$action = "operaciones/registrar_historia.php";
$id = 0;
$titulo_historia = "";
$descripcion = "";
$responsable = "";
$estado = "nueva";
$puntos = "";
$fecha_creacion = date("Y-m-d");
$fecha_finalizacion = "";
$sprint_id = "";
$sprints = [];

$controller_historia = ControllersConfig::get_historias_controller();
$controller_sprint = ControllersConfig::get_sprints_controller();
$sprints = $controller_sprint->get_sprints_all();

if (!empty($_GET['id'])) {
    $titulo = "Modificar historia de usuario";
    $action = "operaciones/modificar_historia.php";
    $id = $_GET['id'];
    $historia = $controller_historia->get_historia($id);
    $titulo_historia = $historia->get_titulo();
    $descripcion = $historia->get_descripcion();
    $responsable = $historia->get_responsable();
    $estado = $historia->get_estado();
    $puntos = $historia->get_puntos();
    $fecha_creacion = $historia->get_fecha_creacion();
    $fecha_finalizacion = $historia->get_fecha_finalizacion();
    $sprint_id = $historia->get_sprint_id();
} else
if (!empty($_GET['sprint_id'])) {
    $sprint_id = $_GET['sprint_id'];
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
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo_historia; ?>" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required><?php echo $descripcion; ?></textarea>
        </div>
        <div>
            <label for="responsable">Responsable:</label>
            <input type="text" id="responsable" name="responsable" value="<?php echo $responsable; ?>" required>
        </div>
        <div>
            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
                <option value="nueva" <?php echo $estado == 'nueva' ? 'selected' : ''; ?>>Nueva</option>
                <option value="activa" <?php echo $estado == 'activa' ? 'selected' : ''; ?>>Activa</option>
                <option value="finalizada" <?php echo $estado == 'finalizada' ? 'selected' : ''; ?>>Finalizada</option>
                <option value="impedimento" <?php echo $estado == 'impedimento' ? 'selected' : ''; ?>>Impedimento</option>
            </select>
        </div>
        <div>
            <label for="puntos">Puntos de complejidad:</label>
            <input type="number" id="puntos" name="puntos" min="0" value="<?php echo $puntos; ?>" required>
        </div>
        <div>
            <label for="fecha_creacion">Fecha de creación:</label>
            <input type="date" id="fecha_creacion" name="fecha_creacion" value="<?php echo $fecha_creacion; ?>" required>
        </div>
        <div>
            <label for="fecha_finalizacion">Fecha de finalización:</label>
            <input type="date" id="fecha_finalizacion" name="fecha_finalizacion" value="<?php echo $fecha_finalizacion; ?>">
        </div>
        <div>
            <label for="sprint_id">Sprint:</label>
            <select id="sprint_id" name="sprint_id" required>
                <option value="">Seleccionar sprint</option>
                <?php foreach ($sprints as $sprint): ?>
                    <option value="<?php echo $sprint->get_id(); ?>" <?php echo $sprint_id == $sprint->get_id() ? 'selected' : ''; ?>>
                        <?php echo $sprint->get_nombre(); ?> (<?php echo $sprint->get_fecha_inicio(); ?> al <?php echo $sprint->get_fecha_fin(); ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>

</html>