<?php

namespace app\models\entities;

class Historia
{
    private int $id;
    private string $titulo;
    private string $descripcion;
    private string $responsable;
    private string $estado;
    private int $puntos;
    private string $fecha_creacion;
    private ?string $fecha_finalizacion;
    private int $sprint_id;
    private string $created_at;
    private string $updated_at;

    public function __construct(
        int $id,
        string $titulo,
        string $descripcion,
        string $responsable,
        string $estado,
        int $puntos,
        string $fecha_creacion,
        ?string $fecha_finalizacion = null,
        int $sprint_id = 0,
        string $created_at = "",
        string $updated_at = ""
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->responsable = $responsable;
        $this->estado = $estado;
        $this->puntos = $puntos;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_finalizacion = $fecha_finalizacion;
        $this->sprint_id = $sprint_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function get_id(): int
    {
        return $this->id;
    }
    public function get_titulo(): string
    {
        return $this->titulo;
    }
    public function get_descripcion(): string
    {
        return $this->descripcion;
    }
    public function get_responsable(): string
    {
        return $this->responsable;
    }
    public function get_estado(): string
    {
        return $this->estado;
    }
    public function get_puntos(): int
    {
        return $this->puntos;
    }
    public function get_fecha_creacion(): string
    {
        return $this->fecha_creacion;
    }
    public function get_fecha_finalizacion(): ?string
    {
        return $this->fecha_finalizacion;
    }
    public function get_sprint_id(): int
    {
        return $this->sprint_id;
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
