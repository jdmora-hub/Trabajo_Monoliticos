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

<?php require __DIR__ . '/partials/layout.php'; ui_header('Informes', 'informe.php'); ?>
    <h2>Informe General</h2>
    <ul>
        <li><strong>Total de historias:</strong> <?php echo $informe_general['total']; ?></li>
        <li><strong>Finalizadas:</strong> <?php echo $informe_general['finalizadas']; ?></li>
        <li><strong>Pendientes:</strong> <?php echo $informe_general['pendientes']; ?></li>
        <li><strong>Con impedimentos:</strong> <?php echo $informe_general['impedimentos']; ?></li>
    </ul>
    <h2>Informe por sprint</h2>
    <div class="table-scroll"><table>
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
                        <td><?php echo ui_escape($fila['sprint']); ?></td>
                        <td><?php echo $fila['total']; ?></td>
                        <td><?php echo $fila['finalizadas']; ?></td>
                        <td><?php echo $fila['pendientes']; ?></td>
                        <td><?php echo $fila['impedimentos']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table></div>


    <h2>Informe por responsable</h2>
    <div class="table-scroll"><table>
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
                        <td><?php echo ui_escape($fila['responsable']); ?></td>
                        <td><?php echo $fila['total']; ?></td>
                        <td><?php echo $fila['finalizadas']; ?></td>
                        <td><?php echo $fila['pendientes']; ?></td>
                        <td><?php echo $fila['impedimentos']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table></div>


<?php 
