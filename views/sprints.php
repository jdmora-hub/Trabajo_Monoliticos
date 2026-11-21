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

<?php $sprints = ControllersConfig::get_sprints_controller()->get_sprints_all(); ?><?php require __DIR__ . '/partials/layout.php';
                                                                                    ui_header('Gestión de Sprints', 'sprints.php'); ?>
<h2>Lista de Sprints</h2>
<div class="table-scroll">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nombre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($sprints)): ?><tr>
                    <td colspan="5">No hay sprints...</td>
                </tr><?php endif; ?>
            <?php foreach ($sprints as $sprint): ?><tr>
                    <td><?php echo $sprint->get_id(); ?></td>
                    <td><?php echo ui_escape($sprint->get_nombre()); ?></td>
                    <td><?php echo ui_escape($sprint->get_fecha_inicio()); ?></td>
                    <td><?php echo ui_escape($sprint->get_fecha_fin()); ?></td>
                    <td>
                        <div class="actions"><a class="button" href="sprints.php?id=<?php echo $sprint->get_id(); ?>#editor">Editar</a><a class="button danger" href="operaciones/borrar_sprint.php?id=<?php echo $sprint->get_id(); ?>" onclick="return confirm('¿Estás seguro de eliminar este sprint?')">Eliminar</a><a href="historias.php?sprint_id=<?php echo $sprint->get_id(); ?>#editor">Nueva historia</a></div>
                    </td>
                </tr><?php endforeach; ?></tbody>
    </table>
</div><a class="button" data-open-editor href="sprints.php?nuevo=1#editor">Nuevo Sprint</a>
<form <?php if (empty($_GET['id']) && empty($_GET['nuevo']) && empty($_GET['sprint_id'])) echo 'hidden'; ?> id="editor" action="<?php echo $action; ?>" method="post">
    <h3><?php echo ui_escape($titulo); ?></h3>
    <input type="hidden" name="id" value="<?php echo ui_escape($id); ?>">
    <div>
        <label for="nombre">Nombre del sprint:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo ui_escape($nombre); ?>" required>
    </div>
    <div>
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo ui_escape($fecha_inicio); ?>" required>
    </div>
    <div>
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo ui_escape($fecha_fin); ?>" required>
    </div>
    <div>
        <a class="button secondary" href="sprints.php">Cancelar</a> <button type="submit">Guardar</button>
    </div>
</form>
<?php
