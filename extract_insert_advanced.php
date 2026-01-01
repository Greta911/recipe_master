<?php
// Chemin du fichier SQL original
$inputFile = 'C:\Users\olive\Bureau\db_remplie.sql';

// Chemin du nouveau fichier SQL contenant uniquement les INSERT
$outputFile = 'C:\Users\olive\Bureau\db_remplie.sql';

// Lire le fichier ligne par ligne
$handle = fopen($inputFile, "r");
if (!$handle) {
    die("Impossible d’ouvrir le fichier $inputFile\n");
}

$output = '';
$insideInsert = false;

while (($line = fgets($handle)) !== false) {
    $trimLine = trim($line);

    // Début d'un bloc INSERT
    if (stripos($trimLine, 'INSERT INTO') === 0) {
        $insideInsert = true;
        $output .= $line;
        continue;
    }

    // Fin d'un bloc INSERT (ligne se terminant par ;)
    if ($insideInsert) {
        $output .= $line;
        if (substr(trim($line), -1) === ';') {
            $insideInsert = false;
        }
        continue;
    }

    // Ignorer toutes les autres lignes (CREATE, DROP, ALTER, SET, etc.)
}

fclose($handle);

// Écrire le fichier final
file_put_contents($outputFile, $output);

echo "Fichier SQL filtré créé : $outputFile\n";
