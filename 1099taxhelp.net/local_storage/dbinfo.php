<?php
switch ($_SERVER['SERVER_NAME']){
    case 'dev.1099taxhelp.net':
        $dbDatabase = 'flm_fth';
        $dbUsername = 'root';
        $dbPassword = '';
        break;
    case 'freshtaxhelp.dev':
        $dbDatabase = 'fth_submissions';
        $dbUsername = 'root';
        $dbPassword = 'MacLocal';
        break;
    case 'www.1099taxhelp.net':
    default:
        $dbDatabase = 'taxhelp1_leads';
        $dbUsername = 'taxhelp1_leads';
        $dbPassword = 's}&]7?k^A{$r6[aPbf';
    break;
}
