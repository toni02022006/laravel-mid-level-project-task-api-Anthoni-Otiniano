<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Importar la clase Str

class Project extends Model
{
    use HasFactory;

    // Desactivar el auto-incrementing para el ID
    public $incrementing = false;

    // Indicar que el tipo de clave primaria es string (UUID)
    protected $keyType = 'string';

    // Sobrescribir el método boot para generar el UUID antes de crear
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    // Definir los campos que se pueden asignar masivamente (fillable)
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    // Relación con las Tareas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}