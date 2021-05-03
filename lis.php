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
	readline_add_history($str = readline($prompt));
	$tokens = preg_split("/\s+/", preg_replace("/([\(\)])/", " $1 ", $str),
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
function _eval ($exp, &$env) {
	if(!is_array($exp))
		return get_env($exp, $env);
	elseif("label" == $exp[0])
		return $env[$exp[1]] = _eval($exp[2], $env);
	elseif("lambda" == $exp[0])
		return ["closure", ["parent" => &$env], $exp[1], $exp[2]];
	else {
		foreach($exp as $i => $o)
		$exp[$i] = _eval($o, $env);
		$proc = array_shift($exp);
		foreach($proc[2] as $i => $f)
		$proc[1][$f] = $exp[$i];
		return _eval($proc[3], $proc[1]);
	}
}
function get_env($key, $env) {
	if(isset($env[$key]))
		return $env[$key];
	elseif(isset($env["parent"]))
		return get_env($key, $env["parent"]);
	return $key;
}
function _print ($x) {
	if(is_array($x))
		print_r($x);
	else
		echo "$x\n";
}
function repl ($prompt, $env=[]) {
	for(;;)	_print(_eval(_read($prompt), $env));
}
?>
