<?php

namespace app\models\repositories\historias_respository;

use app\models\database\HistoriasDBInterface;
use app\models\entities\Historia;
use app\models\mappers\HistoriaMappers;
use Exception;

class HistoriasRespository implements HistoriasRespositoryInterface
{
    private HistoriasDBInterface $historias_db;

    public function __construct(HistoriasDBInterface $historias_db)
    {
        $this->historias_db = $historias_db;
    }

    public function get_historias(): array
    {
        $sql = "select * from historias order by sprint_id, id";
        $historias_db = $this->historias_db->query_select($sql);
        return array_map(
            fn($row): Historia => HistoriaMappers::to_entity($row),
            $historias_db
        );
    }

    public function get_historias_por_sprint(int $sprint_id): array
    {
        $sql = "select * from historias where sprint_id=$sprint_id order by id";
        $historias_db = $this->historias_db->query_select($sql);
        return array_map(
            fn($row): Historia => HistoriaMappers::to_entity($row),
            $historias_db
        );
    }

    public function save_new_historia(Historia $historia): bool
    {
        $fecha_finalizacion = !empty($historia->get_fecha_finalizacion())
            ? "'" . $historia->get_fecha_finalizacion() . "'"
            : "NULL";
        $sql = "insert into historias (titulo, descripcion, responsable, estado, puntos, fecha_creacion, fecha_finalizacion, sprint_id) values";
        $sql .= "('" . $historia->get_titulo() . "', '" . $historia->get_descripcion() . "', '" . $historia->get_responsable() . "', '" . $historia->get_estado() . "', " . $historia->get_puntos() . ", '" . $historia->get_fecha_creacion() . "', " . $fecha_finalizacion . ", " . $historia->get_sprint_id() . ")";
        return $this->historias_db->query($sql);
    }

    public function update_historia(Historia $historia): bool
    {
        $fecha_finalizacion = !empty($historia->get_fecha_finalizacion())
            ? "'" . $historia->get_fecha_finalizacion() . "'"
            : "NULL";
        $sql = "update historias set ";
        $sql .= " titulo='" . $historia->get_titulo() . "', ";
        $sql .= " descripcion='" . $historia->get_descripcion() . "', ";
        $sql .= " responsable='" . $historia->get_responsable() . "', ";
        $sql .= " estado='" . $historia->get_estado() . "', ";
        $sql .= " puntos=" . $historia->get_puntos() . ", ";
        $sql .= " fecha_creacion='" . $historia->get_fecha_creacion() . "', ";
        $sql .= " fecha_finalizacion=" . $fecha_finalizacion . ", ";
        $sql .= " sprint_id=" . $historia->get_sprint_id() . " ";
        $sql .= " where id=" . $historia->get_id();
        return $this->historias_db->query($sql);
    }

    public function find_historia_by_id(int $id): Historia
    {
        $sql = "select * from historias where id=$id";
        $historias = $this->historias_db->query_select($sql);
        if (count($historias) == 0) {
            throw new Exception("Historia no encontrada", 2);
        }
        return HistoriaMappers::to_entity($historias[0]);
    }

    public function delete_historia(int $id): bool
    {
        $sql = "delete from historias where id=$id";
        return $this->historias_db->query($sql);
    }

    public function get_informe_por_responsable(): array
    {
        $sql = "select responsable,
                       count(*) as total,
                       sum(case when estado = 'finalizada' then 1 else 0 end) as finalizadas,
                       sum(case when estado in ('nueva','activa') then 1 else 0 end) as pendientes,
                       sum(case when estado = 'impedimento' then 1 else 0 end) as impedimentos
                from historias
                group by responsable
                order by responsable";
        return $this->historias_db->query_select($sql);
    }

    public function get_informe_por_sprint(): array
    {
        $sql = "select s.nombre as sprint,
                       count(h.id) as total,
                       sum(case when h.estado = 'finalizada' then 1 else 0 end) as finalizadas,
                       sum(case when h.estado in ('nueva','activa') then 1 else 0 end) as pendientes,
                       sum(case when h.estado = 'impedimento' then 1 else 0 end) as impedimentos
                from sprints s
                left join historias h on h.sprint_id = s.id
                group by s.id, s.nombre
                order by s.nombre";
        return $this->historias_db->query_select($sql);
    }

    public function get_informe_general(): array
    {
        $sql = "select 
                       count(*) as total,
                       sum(case when estado = 'finalizada' then 1 else 0 end) as finalizadas,
                       sum(case when estado in ('nueva','activa') then 1 else 0 end) as pendientes,
                       sum(case when estado = 'impedimento' then 1 else 0 end) as impedimentos
                from historias";
        $result = $this->historias_db->query_select($sql);
        return $result[0];
    }
}
?>