<?php L("> ");
function R($P) { return @T(preg_split("/(\(|\))| /", readline($P), -1, 3)); }
function T(&$T) {
	if(($t = array_shift($T)) != "(") return $t;
	$L = [];
	while($T[0] != ")") $L[] = T($T);
	array_shift($T);
	return $L;
}
function E($X, &$E) {
	if(!is_array($X))
		return $X && @$E[$X] ? $E[$X] : (@$E[0] ? E($X, $E[0]) : $X);
	elseif("def" == $X[0]) return $E[$X[1]] = E($X[2], $E);
	elseif("fn" == $X[0]) return [$X[1], $X[2], [&$E]];
	$X[0] = E($X[0], $E);
	$F = [$X[0][2]];
	foreach($X[0][0] as $i => $f) $F[$f] = E($X[$i + 1], $E);
	return E($X[0][1], $F);
}
function L($P, $E=[]) { for(;;) echo print_r(E(R($P),$E), 1), "\n"; }
