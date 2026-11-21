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

<?php $historias = $controller_historia->get_historias_all();
$sprint_nombres = [];
foreach ($sprints as $sprint) {
    $sprint_nombres[$sprint->get_id()] = $sprint->get_nombre();
} ?><?php require __DIR__ . '/partials/layout.php';
                                                                                                                                                                                    ui_header('Historias de Usuario', 'historias.php'); ?>
<h2>Lista de Historias</h2>
<div class="table-scroll">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Título</th>
                <th>Responsable</th>
                <th>Estado</th>
                <th>Puntos</th>
                <th>Sprint</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historias as $historia): ?><tr>
                    <td><?php echo $historia->get_id(); ?></td>
                    <td><?php echo ui_escape($historia->get_titulo()); ?></td>
                    <td><?php echo ui_escape($historia->get_responsable()); ?></td>
                    <td><?php echo ui_escape($historia->get_estado()); ?></td>
                    <td><?php echo $historia->get_puntos(); ?></td>
                    <td><?php echo ui_escape($sprint_nombres[$historia->get_sprint_id()] ?? 'Sin sprint'); ?></td>
                    <td>
                        <div class="actions"><a class="button" href="historias.php?id=<?php echo $historia->get_id(); ?>#editor">Editar</a><a class="button danger" href="operaciones/borrar_historia.php?id=<?php echo $historia->get_id(); ?>" onclick="return confirm('¿Estás seguro de eliminar esta historia?')">Eliminar</a></div>
                    </td>
                </tr><?php endforeach; ?><tr id="sinHistorias" <?php if (!empty($historias)) echo 'hidden'; ?>>
                <td colspan="7">No hay historias...</td>
            </tr>
        </tbody>
    </table>
</div><a class="button" data-open-editor href="historias.php?nuevo=1#editor">Nueva Historia</a>
<form <?php if (empty($_GET['id']) && empty($_GET['nuevo']) && empty($_GET['sprint_id'])) echo 'hidden'; ?> id="editor" action="<?php echo $action; ?>" method="post">
    <h3><?php echo ui_escape($titulo); ?></h3>
    <input type="hidden" name="id" value="<?php echo ui_escape($id); ?>">
    <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo ui_escape($titulo_historia); ?>" required>
    </div>
    <div>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo ui_escape($descripcion); ?></textarea>
    </div>
    <div>
        <label for="responsable">Responsable:</label>
        <input type="text" id="responsable" name="responsable" value="<?php echo ui_escape($responsable); ?>" required>
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
        <input type="number" id="puntos" name="puntos" min="0" value="<?php echo ui_escape($puntos); ?>" required>
    </div>
    <div>
        <label for="fecha_creacion">Fecha de creación:</label>
        <input type="date" id="fecha_creacion" name="fecha_creacion" value="<?php echo ui_escape($fecha_creacion); ?>" required>
    </div>
    <div>
        <label for="fecha_finalizacion">Fecha de finalización:</label>
        <input type="date" id="fecha_finalizacion" name="fecha_finalizacion" value="<?php echo ui_escape($fecha_finalizacion); ?>">
    </div>
    <div>
        <label for="sprint_id">Sprint:</label>
        <select id="sprint_id" name="sprint_id" required>
            <option value="">Seleccionar sprint</option>
            <?php foreach ($sprints as $sprint): ?>
                <option value="<?php echo $sprint->get_id(); ?>" <?php echo $sprint_id == $sprint->get_id() ? 'selected' : ''; ?>>
                    <?php echo ui_escape($sprint->get_nombre()); ?> (<?php echo $sprint->get_fecha_inicio(); ?> al <?php echo $sprint->get_fecha_fin(); ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <a class="button secondary" href="historias.php">Cancelar</a> <button type="submit">Guardar</button>
    </div>
</form>
