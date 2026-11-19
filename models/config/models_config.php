<?php

namespace app\models\config;

use app\models\database\HistoriasDB;
use app\models\database\HistoriasDBInterface;
use app\models\repositories\historias_respository\HistoriasRespository;
use app\models\repositories\historias_respository\HistoriasRespositoryInterface;
use app\models\repositories\sprints_respository\SprintsRespository;
use app\models\repositories\sprints_respository\SprintsRespositoryInterface;

class ModelsConfig
{
    public static function get_historias_db(): HistoriasDBInterface
    {
        return new HistoriasDB();
    }

    public static function get_historias_respository(): HistoriasRespositoryInterface
    {
        return new HistoriasRespository(ModelsConfig::get_historias_db());
    }

    public static function get_sprints_respository(): SprintsRespositoryInterface
    {
        return new SprintsRespository(ModelsConfig::get_historias_db());
    }
}
