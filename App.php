<?php

require_once 'Repositories/UserRepository.php';

$userRepository = new UserRepository();

$id = 4;
$queryResult = $userRepository->getById($id);

//$name = 'danil';
//$queryResult = $userRepository->getAllEmailsByName($name);

var_dump($queryResult);






