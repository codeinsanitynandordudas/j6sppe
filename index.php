<?php

header('Content-Type: text/html; charset=utf-8');

if ( gethostname() == 'dev.j6sppe' ) {
  define('ENVIRONMENT', 'development');
} else {
  define('ENVIRONMENT', 'local');
}

if (ENVIRONMENT == 'local') {
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
} else {
  error_reporting(0);
}

require_once 'functions.inc.php';

$user_role =  get_user_role(2);

$exams = get_all_exams();

dd($exams);