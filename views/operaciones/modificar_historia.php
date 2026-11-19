<?php
require "../../models/database/historias_db_interface.php";
require "../../models/database/historias_db.php";
require "../../models/entities/historia.php";
require "../../models/mappers/historia_mappers.php";
require "../../models/repositories/historias_respository/historias_respository_interface.php";
require "../../models/repositories/historias_respository/historias_respository.php";
require "../../models/config/models_config.php";

require "../../controllers/mappers/historias_mapper_controller.php";
require "../../controllers/historias/historias_controller_interface.php";
require "../../controllers/historias/historias_controller.php";
require "../../controllers/config/controllers_config.php";

use app\controllers\config\ControllersConfig;

$controller = ControllersConfig::get_historias_controller();

$ok = $controller->update_historia($_POST);
if ($ok) {
    header("Location: ../inicio.php?exito=1");
} else {
    header("Location: ../inicio.php?error=1");
}
