<div dir=rtl>

# تاوتۆکەرێکی بچووکی لیسپ لە ٥٩١پیت‌دا

</div>

```
<?php L("> ");function R($P){return@T(preg_split("/\s+/",preg_replace("/(\(|\))/"," $1 ",readline($P)),-1,PREG_SPLIT_NO_EMPTY));}function T(&$T){if(($t=array_shift($T))!="(")return$t;while($T[0]!=")")$L[]=T($T);array_shift($T);return$L;}function E($X,&$E){if(!is_array($X))return@$E[$X]?$E[$X]:(@$E[".."]?E($X,$E[".."]):$X);elseif("label"==$X[0])return$E[$X[1]]=E($X[2],$E);elseif("lambda"==$X[0])return[$X[1],$X[2],[".."=>&$E]];$X[0]=E($X[0],$E);foreach($X[0][0]as$i=>$f)$X[0][2][$f]=E($X[$i+1],$E);return E($X[0][1],$X[0][2]);}function L($P,$E=[]){for(;;)echo print_r(E(R($P),$E),1),"\n";}
```
