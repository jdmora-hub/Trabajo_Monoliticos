<?php

namespace app\controllers\informes;

interface InformesControllerInterface
{
    public function get_informe_por_responsable(): array;

    public function get_informe_por_sprint(): array;

    public function get_informe_general(): array;
}
?>