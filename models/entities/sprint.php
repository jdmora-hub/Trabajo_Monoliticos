<?php

namespace app\models\entities;

class Sprint
{
    private int $id;
    private string $nombre;
    private string $fecha_inicio;
    private string $fecha_fin;
    private string $created_at;
    private string $updated_at;

    public function __construct(
        int $id,
        string $nombre,
        string $fecha_inicio,
        string $fecha_fin,
        string $created_at = "",
        string $updated_at = ""
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function get_id(): int
    {
        return $this->id;
    }
    public function get_nombre(): string
    {
        return $this->nombre;
    }
    public function get_fecha_inicio(): string
    {
        return $this->fecha_inicio;
    }
    public function get_fecha_fin(): string
    {
        return $this->fecha_fin;
    }
    public function get_created_at(): string
    {
        return $this->created_at;
    }
    public function get_updated_at(): string
    {
        return $this->updated_at;
    }
}
