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

*/

function getChLevel($ch) {
	
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
