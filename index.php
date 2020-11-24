<?php

include "vendor/autoload.php";

use \App\Storage\StorageClient;
use \App\Storage\FileStorage;
use App\Units\HeroBuilder;
use \App\Units\BaseUnitBuilder;
use \App\Battle\Battle;
use \App\Output\OutputFactory;
use \App\Battle\Disposition;

$storageClient = new StorageClient(new FileStorage());
$orderusConfig = $storageClient->getPropertiesRangeForUnit("heroes", "Hero");

$wildBeastConfig = $storageClient->getPropertiesRangeForUnit('opponents', 'Wild Beast');

$orderusBuilder = new HeroBuilder($orderusConfig);
$orderus = $orderusBuilder->build();

$wildBeastBuilder = new BaseUnitBuilder($wildBeastConfig);
$wildBeast = $wildBeastBuilder->build();


$battle = new Battle(OutputFactory::build('cli'));
$battle->run(new Disposition($orderus, $wildBeast));

