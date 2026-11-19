<?php

namespace app\models\mappers;

use app\models\entities\Historia;

class HistoriaMappers
{
    public static function to_entity(array $row_db): Historia
    {
        return new Historia(
            $row_db["id"],
            $row_db["titulo"],
            $row_db["descripcion"],
            $row_db["responsable"],
            $row_db["estado"],
            $row_db["puntos"],
            $row_db["fecha_creacion"],
            $row_db["fecha_finalizacion"],
            $row_db["sprint_id"],
            $row_db["created_at"],
            $row_db["updated_at"]
        );
    }
}
