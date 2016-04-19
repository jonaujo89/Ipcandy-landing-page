<?php

function punycode_to_unicode($input) {
	$prefix = 'xn--'; $safe_char = 0xFFFC;  $base = 36; $tmin = 1; $tmax = 26; $skew = 38; $damp = 700; $output_parts=array(); 

	$enco_parts=(array)explode('.',$input);  
	foreach ($enco_parts as $encoded) {	// loop through each part of a host domain,  ie. subdomain.subdomain.domain.tld

	if (strpos($encoded,$prefix)!==0 || strlen(trim(str_replace($prefix,'',$encoded)))==0) { $output_parts[]=$encoded; continue; }

	$is_first = true; $bias = 72; $idx = 0;  $char = 0x80; $decoded = array();	$output='';

	$delim_pos = strrpos($encoded, '-');
	if ($delim_pos > strlen($prefix)) { for ($k = strlen($prefix); $k < $delim_pos; ++$k) { $decoded[] = ord($encoded{$k}); } }
	$deco_len = count($decoded);
	$enco_len = strlen($encoded);

	for ($enco_idx = $delim_pos ? ($delim_pos + 1) : 0; $enco_idx < $enco_len; ++$deco_len) {        
		for ($old_idx = $idx, $w = 1, $k = $base; 1 ; $k += $base) {
			$cp = ord($encoded{$enco_idx++});
        			$digit = ($cp - 48 < 10) ? $cp - 22 : (($cp - 65 < 26) ? $cp - 65 : (($cp - 97 < 26) ? $cp - 97 : $base));
                		$idx += $digit * $w;
                		$t = ($k <= $bias) ? $tmin : (($k >= $bias + $tmax) ? $tmax : ($k - $bias));
                		if ($digit < $t) { break; }
                		$w = (int) ($w * ($base - $t));
            		}
		$delta = $idx - $old_idx;		
		$delta = intval($is_first ? ($delta / $damp) : ($delta / 2));
		$delta += intval($delta / ($deco_len + 1));
		for ($k = 0; $delta > (($base - $tmin) * $tmax) / 2; $k += $base) { $delta = intval($delta / ($base - $tmin)); }
		$bias = intval($k + ($base - $tmin + 1) * $delta / ($delta + $skew));
		$is_first = false;
		$char += (int) ($idx / ($deco_len + 1));
		$idx %= ($deco_len + 1);
		if ($deco_len > 0) { for ($i = $deco_len; $i > $idx; $i--) { $decoded[$i] = $decoded[($i - 1)]; } }
            		$decoded[$idx++] = $char;
        	}

        	foreach ($decoded as $k => $v) {
            		if ($v < 128) { $output .= chr($v); } // 7bit are transferred literally
		elseif ($v < (1 << 11)) { $output .= chr(192+($v >> 6)).chr(128+($v & 63)); } // 2 bytes
		elseif ($v < (1 << 16)) { $output .= chr(224+($v >> 12)).chr(128+(($v >> 6) & 63)).chr(128+($v & 63)); } // 3 bytes
		elseif ($v < (1 << 21)) { $output .= chr(240+($v >> 18)).chr(128+(($v >> 12) & 63)).chr(128+(($v >> 6) & 63)).chr(128+($v & 63)); } // 4 bytes
		else { $output .= $safe_char; } //  'Conversion from UCS-4 to UTF-8 failed: malformed input at byte '.$k
	}
	$output_parts[]=$output;
	
	}  // $enco_parts loop

	return implode('.',$output_parts);
}