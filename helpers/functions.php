<?php

function returnJson($retorno) {
	header("Content-Type: application/json");
	echo json_encode($retorno, JSON_PRETTY_PRINT);
	exit;
}