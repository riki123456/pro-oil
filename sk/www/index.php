<?php

// Uncomment this line if you must temporarily take down your site for maintenance.
// require __DIR__ . '/.maintenance.php';

$container = require __DIR__ . '/../App/bootstrap.php';

$container->getByType('Nette\Application\Application')->run();


/*
//$a = array();

$coord[] = array(23.4, 13);
$coord[] = array(13, 80);
$coord[] = array(33, 43);
$coord[] = array(98, 553);
$coord[] = array(3, 6);
$coord[] = array(64, 23);
$coord[] = array(234, 113);

$o[] = array('id' => 0, 'source_id' => 0, 'rotation' => 90, 'vflip' => false, 'hflip' => true, 'layer' => 3, 'coord' => $coord);
$o[] = array('id' => 1, 'source_id' => 3, 'rotation' => 0, 'vflip' => true, 'hflip' => true, 'layer' => 1, 'coord' => $coord);
$o[] = array('id' => 2, 'source_id' => 12, 'rotation' => 120, 'vflip' => false, 'hflip' => false, 'layer' => 2, 'coord' => $coord);

$objects = $o;

Tracy\Debugger::dump($o);
$ojson = json_encode($o);
var_dump($ojson);
//print_r($a);



die(__METHOD__);
 */