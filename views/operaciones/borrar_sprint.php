<?php
require "../../models/database/historias_db_interface.php";
require "../../models/database/historias_db.php";
require "../../models/entities/sprint.php";
require "../../models/mappers/sprint_mappers.php";
require "../../models/repositories/sprints_respository/sprints_respository_interface.php";
require "../../models/repositories/sprints_respository/sprints_respository.php";
require "../../models/config/models_config.php";

require "../../controllers/mappers/sprints_mapper_controller.php";
require "../../controllers/sprints/sprints_controller_interface.php";
require "../../controllers/sprints/sprints_controller.php";
require "../../controllers/config/controllers_config.php";

use app\controllers\config\ControllersConfig;

$controller = ControllersConfig::get_sprints_controller();

$ok = $controller->delete_sprint($_GET["id"]);
if ($ok) {
    header("Location: ../inicio.php?exito=1");
} else {
    header("Location: ../inicio.php?error=1");
}
?>