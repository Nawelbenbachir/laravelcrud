<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cp_VilleSeeder extends Seeder
{
    public function run()
    {
        $csvPath = storage_path('app\codes_postaux.csv');

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
                        'ville' => $data['Nom_de_la_commune'],
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