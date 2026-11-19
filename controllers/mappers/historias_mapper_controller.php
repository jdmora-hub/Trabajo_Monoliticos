<?php

namespace app\controllers\mappers;

use app\models\entities\Historia;

class HistoriasMapperController
{
    public static function to_entity(array $request): Historia
    {
        return new Historia(
            empty($request['id']) ? 0 : $request['id'],
            $request['titulo'],
            $request['descripcion'],
            $request['responsable'],
            $request['estado'],
            $request['puntos'],
            $request['fecha_creacion'],
            empty($request['fecha_finalizacion']) ? null : $request['fecha_finalizacion'],
            empty($request['sprint_id']) ? 0 : $request['sprint_id']
        );
    }
}
