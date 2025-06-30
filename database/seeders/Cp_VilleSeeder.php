<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodesPostauxSeeder extends Seeder
{
    public function run()
    {
        $csvPath = storage_path('app/codes_postaux.csv');

        if (!file_exists($csvPath)) {
            $this->command->error("Fichier CSV introuvable: $csvPath");
            return;
        }

        if (($handle = fopen($csvPath, "r")) !== false) {
            $header = null;

            while (($row = fgetcsv($handle, 1000, ";")) !== false) {
                if (!$header) {
                    $header = $row;
                    continue;
                }

                $data = array_combine($header, $row);

                DB::table('cp_villes')->updateOrInsert(
                    ['code_postal' => $data['Code_postal']],
                    [
                        'code_commune_insee' => $data['Code_commune_INSEE'],
                        'nom_commune' => $data['Nom_de_la_commune'],
                        // 'libelle_acheminement' ignoré
                        //'ligne_5' => $data['Ligne_5'],
                    ]
                );
            }
            fclose($handle);
            $this->command->info('Import CSV terminé sans libellé d\'acheminement.');
        } else {
            $this->command->error("Impossible d'ouvrir le fichier CSV.");
        }
    }
}