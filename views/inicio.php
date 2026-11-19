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

$sprint_controller = ControllersConfig::get_sprints_controller();
$sprints = $sprint_controller->get_sprints_all();

$historia_controller = ControllersConfig::get_historias_controller();
$historias = $historia_controller->get_historias_all();

// Agrupar historias por sprint
$historias_por_sprint = [];
foreach ($historias as $historia) {
    $sid = $historia->get_sprint_id();
    if (!isset($historias_por_sprint[$sid])) {
        $historias_por_sprint[$sid] = [];
    }
    array_push($historias_por_sprint[$sid], $historia);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Historias de Usuario</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <h1>Gestor de Historias de Usuario</h1>
    <br>
    <a href="sprint_form.php">Crear sprint</a>
    &nbsp;&nbsp;
    <a href="historia_form.php">Crear historia de usuario</a>
    &nbsp;&nbsp;
    <a href="informe.php">Ver informe</a>
    <br><br>

    <?php
    if (!empty($_GET['error'])) {
        echo '<p style="color:red;">Error al guardar los datos.</p>';
    }
    if (!empty($_GET['exito'])) {
        echo '<p style="color:green;">Operación realizada correctamente.</p>';
    }
    ?>

    <?php if (empty($sprints)): ?>
        <p>No hay sprints registrados. Crea un sprint primero para poder asignar historias.</p>
    <?php else: ?>
        <?php foreach ($sprints as $sprint): ?>
            <h2>Sprint: <?php echo $sprint->get_nombre(); ?> (<?php echo $sprint->get_fecha_inicio(); ?> al <?php echo $sprint->get_fecha_fin(); ?>)</h2>
            <br>
            <a href="historia_form.php?sprint_id=<?php echo $sprint->get_id(); ?>">+ Nueva historia en este sprint</a>
            &nbsp;&nbsp;
            <a href="sprint_form.php?id=<?php echo $sprint->get_id(); ?>">Editar sprint</a>
            &nbsp;&nbsp;
            <a href="operaciones/borrar_sprint.php?id=<?php echo $sprint->get_id(); ?>" onclick="return confirm('¿Estás seguro de eliminar este sprint? Se eliminarán también sus historias.')">Eliminar sprint</a>
            <br><br>

            <?php
            $historias_sprint = isset($historias_por_sprint[$sprint->get_id()]) ? $historias_por_sprint[$sprint->get_id()] : [];
            if (empty($historias_sprint)): ?>
                <p>Sin historias asignadas a este sprint.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Responsable</th>
                            <th>Estado</th>
                            <th>Puntos</th>
                            <th>Fecha creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historias_sprint as $historia): ?>
                            <tr>
                                <td><?php echo $historia->get_id(); ?></td>
                                <td><?php echo $historia->get_titulo(); ?></td>
                                <td><?php echo $historia->get_responsable(); ?></td>
                                <td><?php echo $historia->get_estado(); ?></td>
                                <td><?php echo $historia->get_puntos(); ?></td>
                                <td><?php echo $historia->get_fecha_creacion(); ?></td>
                                <td>
                                    <a href="historia_form.php?id=<?php echo $historia->get_id(); ?>">Editar</a>
                                    <a href="operaciones/borrar_historia.php?id=<?php echo $historia->get_id(); ?>" onclick="return confirm('¿Estás seguro de eliminar esta historia?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <br><br>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>
