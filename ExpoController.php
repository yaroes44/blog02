<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ExpoController extends Controller
{
    public function exportar()
    {
        $backup = WRITEPATH . 'blog02.sql';

        shell_exec("mysqldump -u " . escapeshellarg(db_connect()->root) . " -p" . escapeshellarg(db_connect()->password) . " " . escapeshellarg(db_connect()->database) . " > " . escapeshellarg($backup));

        return $this->response->download($backup, null)->setFileName(basename($backup));
    }
}
