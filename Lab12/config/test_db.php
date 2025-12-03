<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['defaultDatabaseName'] = 'patient-php-test';

return $db;
