<?php

/*
###
# ThaiSwap: Normalize Thai word
# This is a ported version of th_normalize from libthai projects
# compatible with Browser and CommonJS
#
# PORTED BY : Pakkapon Phongthawee (phongthawee_p@silpakorn.edu)
#
# for Browser:
# <script src="path-to-this-file"></scirpt>
# <script>
#   console.log((ThaiSwap("มั้ง")==ThaiSwap("ม้ัง"))?"It look same":"It isnt same");
# </script>
#
# for CommonJS
# var thaiSwap = require("path-to-this-file");
# console.log((ThaiSwap("มั้ง")==ThaiSwap("ม้ัง"))?"It look same":"It isnt same");
#
# for more information https://github.com/pureexe/ThaiSwap
# Libthai: https://linux.thai.net/projects/libthai
###

levelRef = {
  "ั":1,
  "ิ":1,
  "ี":1,
  "ึ":1,
  "ื":1,
  "ุ":-1,
  "ู":-1,
  "็":3,
  "่":2,
  "้":2,
  "๊":2,
  "๋":2,
  "์":2,
  "ํ":3,
  "๎":1,
}

getChLevel = (ch)->
  if levelRef[ch] then levelRef[ch] else 0

ThaiSwap = (src)->
  dest = ""
  top = up = middle = low = 0
  while(src.length > 0)
    switch getChLevel(src[0])
      when 0
        if middle
          dest += middle
          if low
            dest+= low
          else if up
            dest+=up
          if top
            dest+=top
        top = up = low = 0
        middle = src[0]
      when -1 then low = src[0]
      when 1
        if up and getChLevel(up) == 3
          top = up
        up = src[0]
      when 2 then top = src[0]
      when 3
        if !up
          up = src[0]
        else
          top = src[0]
    src = src.slice(1)
  if middle
    dest+= middle
    if low
      dest+= low
    else if up
      dest+=up
    if(top)
      dest+=top
  return dest

if typeof module == "object" and module and typeof module.exports == "object"
  module.exports = ThaiSwap # support Node.js / IO.js / CommonJS
else
  window.ThaiSwap = ThaiSwap # support Normal browser
  if typeof define == "function" && define.amd
    define 'ThaiSwap', [], -> #support AMDjs
      ThaiSwap
*/

function getChLevel($ch, $levelRef) {
	
	$levelRef = array(
		"ั" => 1,
		"ิ" => 1,
		"ี" => 1,
		"ึ" => 1,
		"ื" => 1,
		"ุ" => -1,
		"ู" => -1,
		"็" => 3,
		"่" => 2,
		"้" => 2,
		"๊" => 2,
		"๋" => 2,
		"์" => 2,
		"ํ" => 3,
		"๎" => 1,
	);
	
	if ($levelRef[$ch]) {
		return $levelRef[$ch];
	} else {
		return 0; 
	}
}

function ThaiSwap($src) {
	$src = trim($src);
	echo '$src='.$src;
	
	$dest = "";
	$top = $up = $middle = $low = "0";

	while(mb_strlen($src, 'UTF-8') > 0) {
	
		switch (getChLevel(iconv_substr($src, 0, 1, "UTF-8"))) {
			case 0:
				//echo "i is 0";
				
				if ($middle != "0") {
					$dest .= $middle;
				
					if ($low!="0") {
						$dest .= $low;
					} else if ($up!="0") {
						$dest .= $up;
					}
					if($top!="0") {
						$dest .= $top;
					}
				}
				$top = $up = $low = "0";
				$middle = iconv_substr($src, 0, 1, "UTF-8");
				
				break;
			case -1:
				//echo "i is -1";
				$low = iconv_substr($src, 0, 1, "UTF-8");
				break;
			case 1:
				//echo "i is 1";
				if ($up and getChLevel($up) == 3)
					$top = $up;
				$up = iconv_substr($src, 0, 1, "UTF-8");
				break;
			case 2:
				//echo "i is 2";
				if($middle==" ") {
					//echo "middle is space"; 
					$top = "";
				} else {
					$top = iconv_substr($src, 0, 1, "UTF-8");
				}
				break;
			case 3:
				//echo "i is 3";
				if (!$up)
					$up = iconv_substr($src, 0, 1, "UTF-8");
				else
					$top = iconv_substr($src, 0, 1, "UTF-8");
	  			break;
		}
		
		//slice(1)
		$src = iconv_substr($src, 1, iconv_strlen($src, "UTF-8"), "UTF-8");
	}
	
	if ($middle != "0") {
		$dest .= $middle;
	
		if ($low!="0") {
			$dest .= $low;
		} else if ($up!="0") {
			$dest .= $up;
		}
		if($top!="0") {
			$dest .= $top;
		}
	}

	return $dest;
}
?>
