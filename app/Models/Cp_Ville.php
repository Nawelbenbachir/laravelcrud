<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cp_Ville extends Model
{
    //le nom de la table est différent du nom du modèle
    // donc on doit le spécifier
    protected $table = 'cp_villes';
    // modérer l'interdiction de la saisie en masse dans le seeder pour la table cp_villes
    protected $fillable = ['code_postal', 'ville'];
}

