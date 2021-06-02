<?php
repl("> ");

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
	return $token;
}
function _eval($exp, &$env) {
	if(!is_array($exp))
		return get($exp, $env);
	elseif("label" == $exp[0])
		return $env[$exp[1]] = _eval($exp[2], $env);
	elseif("lambda" == $exp[0])
		return [$exp[1], $exp[2], ["dad" => &$env]];
	$exp[0] = _eval($exp[0], $env);
	foreach($exp[0][0] as $i => $f)
	$exp[0][2][$f] = _eval($exp[$i + 1], $env);
	return _eval($exp[0][1], $exp[0][2]);
}
function get($key, $env) {
	return isset($env[$key]) ? $env[$key] :
	       (isset($env["dad"]) ? get($key, $env["dad"]) : $key);
}
function _print($x) {
	is_array($x) ? print_r($x) : print("$x\n");
}
function repl($prompt, $env=[]) {
	for(;;)	_print(_eval(_read($prompt), $env));
}
?>
