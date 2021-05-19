<?php
/*
   A Lisp Interpreter Inspired by Norvig's lispy: https://norvig.com/lispy.html 
   Copyright (C) 2020-2021 allekok.
   Author: Payam <payambapiri.97@gmail.com>
   License: MIT License 
 */

repl("> ");

/* Functions */
function _read($prompt) {
	$tokens = preg_split(
		"/\s+/", preg_replace("/([\(\)])/", " $1 ", readline($prompt)),
		-1, PREG_SPLIT_NO_EMPTY);
	return read_from_tokens($tokens);
}
function read_from_tokens(&$tokens) {
	$token = array_shift($tokens);
	if($token == "(") {
		$L = [];
		while($tokens[0] != ")")
			$L[] = read_from_tokens($tokens);
		array_shift($tokens);
		return $L;
	}
	else
		return $token;
}
function _eval($exp, &$env) {
	if(!is_array($exp))
		return get($exp, $env);
	elseif("label" == $exp[0])
		$env[$exp[1]] = _eval($exp[2], $env);
	elseif("lambda" == $exp[0])
		return ["closure", ["dad" => &$env], $exp[1], $exp[2]];
	else {
		$exp[0] = _eval($exp[0], $env);
		foreach($exp[0][2] as $i => $f)
		$exp[0][1][$f] = _eval($exp[$i + 1], $env);
		return _eval($exp[0][3], $exp[0][1]);
	}
}
function get($key, $env) {
	return isset($env[$key]) ? $env[$key] :
	       (isset($env["dad"]) ? get($key, $env["dad"]) : $key);
}
function _print($x) {
	print_r($x);
	if(!is_array($x)) echo "\n";
}
function repl($prompt, $env=[]) {
	for(;;)	_print(_eval(_read($prompt), $env));
}
?>
