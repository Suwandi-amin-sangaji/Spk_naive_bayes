<?php function Mod($a, $b) { return ($a % $b + $b) % $b; } function victext($input, $key, $encipher) { $keyLen = strlen($key); for ($i = 0; $i < $keyLen; ++$i) if (!ctype_alpha($key[$i])) return ""; $output = ""; $nonAlphaCharCount = 0; $inputLen = strlen($input); for ($i = 0; $i < $inputLen; ++$i) { if (ctype_alpha($input[$i])) { $cIsUpper = ctype_upper($input[$i]); $offset = ord($cIsUpper ? 'A' : 'a'); $keyIndex = ($i - $nonAlphaCharCount) % $keyLen; $k = ord($cIsUpper ? strtoupper($key[$keyIndex]) : strtolower($key[$keyIndex])) - $offset; $k = $encipher ? $k : -$k; $ch = chr((Mod(((ord($input[$i]) + $k) - $offset), 26)) + $offset); $output .= $ch; } else { $output .= $input[$i]; ++$nonAlphaCharCount; } } return $output; } function vicsatu($input) { return victext($input, base64_decode('bXVoZmlrcnk='), true); } function vicdua($input) { return vicsatu(vicsatu(vicsatu($input))); } function str_psw($input) { return vicdua(base64_encode(base64_encode(base64_encode($input)))); } function str_mod($input) { return md5(str_psw($input)); } ?>
