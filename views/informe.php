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
require "../controllers/informes/informes_controller_interface.php";
require "../controllers/informes/informes_controller.php";
require "../controllers/config/controllers_config.php";

use app\controllers\config\ControllersConfig;

$controller_informe = ControllersConfig::get_informes_controller();
$informe_responsable = $controller_informe->get_informe_por_responsable();
$informe_sprint = $controller_informe->get_informe_por_sprint();
$informe_general = $controller_informe->get_informe_general();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Historias de Usuario</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <h1>Informe de Historias de Usuario</h1>
    <br>
    <a href="inicio.php">Volver</a>
    <br><br>

    <h2>Informe por responsable</h2>
    <table>
        <thead>
            <tr>
                <th>Responsable</th>
                <th>Total</th>
                <th>Finalizadas</th>
                <th>Pendientes</th>
                <th>Impedimentos</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($informe_responsable)): ?>
                <tr><td colspan="5">No hay datos.</td></tr>
            <?php else: ?>
                <?php foreach ($informe_responsable as $fila): ?>
                    <tr>
                        <td><?php echo $fila['responsable']; ?></td>
                        <td><?php echo $fila['total']; ?></td>
                        <td><?php echo $fila['finalizadas']; ?></td>
                        <td><?php echo $fila['pendientes']; ?></td>
                        <td><?php echo $fila['impedimentos']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <br><br>

    <h2>Informe por sprint</h2>
    <table>
        <thead>
            <tr>
                <th>Sprint</th>
                <th>Total</th>
                <th>Finalizadas</th>
                <th>Pendientes</th>
                <th>Impedimentos</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($informe_sprint)): ?>
                <tr><td colspan="5">No hay datos.</td></tr>
            <?php else: ?>
                <?php foreach ($informe_sprint as $fila): ?>
                    <tr>
                        <td><?php echo $fila['sprint']; ?></td>
                        <td><?php echo $fila['total']; ?></td>
                        <td><?php echo $fila['finalizadas']; ?></td>
                        <td><?php echo $fila['pendientes']; ?></td>
                        <td><?php echo $fila['impedimentos']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <br><br>

    <h2>Informe general</h2>
    <table>
        <thead>
            <tr>
                <th>Total historias</th>
                <th>Finalizadas</th>
                <th>Pendientes</th>
                <th>Impedimentos</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $informe_general['total']; ?></td>
                <td><?php echo $informe_general['finalizadas']; ?></td>
                <td><?php echo $informe_general['pendientes']; ?></td>
                <td><?php echo $informe_general['impedimentos']; ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
