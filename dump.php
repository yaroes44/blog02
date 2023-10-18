<?php

namespace App\Controllers;

class DatabaseExportController extends BaseController
{
    public function exportDatabase()
    {
        $db = \Config\Database::connect();

        $backupFileName = 'bog.sql';

        $backupFilePath = WRITEPATH . 'documentos/';

        if (!is_dir($backupFilePath)) {
            mkdir($backupFilePath, 0755, true);
        }

        $backupFile = $backupFilePath . $backupFileName;

        $command = "mysqldump -u " . $db->username . " -p" . $db->password . " " . $db->database . " > $backupFile";

        exec($command);

        if (is_file($backupFile)) {
            return $this->response->download($backupFile, null);
        } else {
            return "La exportación de la base de datos ha fallado.";
        }
    }
}
