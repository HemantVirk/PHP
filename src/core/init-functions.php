<?php
class core_func {
    public static function fw__json_encode($value, int $flags = 0, int $depth = 512): bool|string
    {
        return json_encode($value, $flags, $depth);
    }
    
    /**
     * @param mixed $json
     * @param null $associative
     * @param int $depth
     * @param int $flags
     * @return bool
     */
    public static function fw__json_validate(mixed $json, $associative = null, int $depth = 512, int $flags = 0): bool
    {
        $output[STATUS] = TRUE;
        // decode the JSON data
        if(is_array($json)) return FALSE;
    
        json_decode($json, $associative, $depth, $flags);
    
        // match and check for possible JSON errors
        $error = match (json_last_error()) {
            JSON_ERROR_NONE => '',
            JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
            JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
            JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON.',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
            JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
            JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
            JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
            default => 'Unknown JSON error occurred.',
        };
    
        if ($error !== '') return FALSE;
    
        // everything is OK
        return TRUE;
    }
    
    /**
     * @param string $json
     * @param bool|null $associative
     * @param int $depth
     * @param int $flags
     * @return mixed
     */
    public static function fw__json_decode($json, $associative = null, int $depth = 512, int $flags = 0): mixed
    {
        if(!is_string($json)) $json = (string)$json;
        return json_decode($json, $associative, $depth, $flags);
    }
    
    /**
     * @param string $string
     * @param string|null $encoding
     * @return string
     */
    public static function fw__mb_strtolower($string, ?string $encoding = "UTF-8"): string
    {
        if(!is_string($string)) $string = (string)$string;
        return mb_strtolower($string, $encoding);
    }
    
    /**
     * @param string $string
     * @param string|null $encoding
     * @return string
     */
    public static function fw__mb_strtoupper($string, ?string $encoding = "UTF-8"): string
    {
        if(!is_string($string)) $string = (string)$string;
        return mb_strtoupper($string, $encoding);
    }
    
    /**
     * @param string $separator
     * @param string $string
     * @param int $limit
     * @return string[]
     */
    public static function fw__explode($separator, $string, $limit=PHP_INT_MAX): array
    {
        if(!is_string($separator)) $separator= (string)$separator;
        if(!is_string($string)) $string= (string)$string;
        return explode($separator, $string, $limit);
    }
    
    /**
     * @param string $separator
     * @param array $array
     * @return string
     */
    public static function fw__implode($separator, $array): string
    {
        if (!is_string($separator)) $separator = (string)$separator;
        if (!is_array($array)) return $array;
        return implode($separator, $array);
    }
    
    /**
     * @param string $haystack
     * @param string $needle
     * @param int $offset
     * @return false|int
     */
    public static function fw__strpos($haystack, $needle, $offset = 0): bool|int
    {
        if(!is_string($haystack)) $haystack = (string)$haystack;
        if(!is_string($needle)) $needle = (string)$needle;
        if(!filter_var($offset, FILTER_VALIDATE_INT)) $offset = 0;
    
        return strpos($haystack, $needle, $offset);
    }
    
    /**
     * @param string $haystack
     * @param string $needle
     * @param int $offset
     * @param string|null $encoding
     * @return false|int
     */
    public static function fw__mb_strpos($haystack, $needle, $offset = 0, ?string $encoding = "UTF-8"): bool|int
    {
        if(!is_string($haystack)) $haystack = (string)$haystack;
        if(!is_string($needle)) $needle = (string)$needle;
        if(!filter_var($offset, FILTER_VALIDATE_INT)) $offset = 0;
        return mb_strpos($haystack, $needle, $offset, $encoding);
    }

    public static function fw__str_replace($search, $replace, $subject, $count = null): string
    {
        if($subject === null)
            $subject = '';
        if(!is_array($search) && !is_string($search))
            $search = (string)$search;
        if(!is_array($replace) && !is_string($replace))
            $replace = (string)$replace;

        return str_replace($search, $replace, $subject, $count);
    }

    /**
     * @param int|float $num
     * @param int $precision
     * @param int $mode
     * @return int|float
     */
    public static function fw__round($num, $precision = 0, $mode = PHP_ROUND_HALF_UP): int|float
    {
        if(!is_numeric($num)) return $num;
        if(!filter_var($num, FILTER_VALIDATE_INT) && !filter_var($num, FILTER_VALIDATE_FLOAT)) {
            $num = (float)$num;
        }
        return round($num, $precision, $mode);
    }
    
    
    /**
     * @param Countable|array $value
     * @param int $mode
     * @return int
     */
    public static function fw__count($value, $mode = COUNT_NORMAL): int
    {
        if(!is_array($value) && !is_object($value)) return 0;
        return count($value, $mode);
    }
    
    
    /**
     * @param array $array
     * @param string|int $column_key
     * @param string|int|null $index_key
     * @return array
     */
    public static function fw__array_column($array, $column_key, $index_key = null): array
    {
        if(!is_array($array)) return [];
        return array_column($array, $column_key, $index_key);
    }
    
    /**
     * @param array $array
     * @return float|int
     */
    public static function fw__array_sum(array $array): float|int
    {
        if(!is_array($array)) return 0;
        return array_sum($array);
    }
    
    /**
     * @param array $array
     * @param int $flags
     * @return bool
     */
    public static function fw__krsort(&$array, $flags = SORT_REGULAR): bool
    {
        if(!is_array($array)) return false;
        return krsort($array, $flags);
    }

    /**
     * @param $array
     * @param $flags
     * @return bool
     */
    public static function fw__sort(&$array, $flags = SORT_REGULAR): bool
    {
        if(!is_array($array)) return false;
        return sort($array, $flags);
    }
    
    
    /**
     * @param mixed $needle
     * @param array $haystack
     * @param bool $strict
     * @return bool
     */
    public static function fw__in_array($needle, $haystack, bool $strict = false): bool
    {
        if(!is_array($haystack)) return false;
        return in_array($needle, $haystack,  $strict);
    }
    
    /**
     * @param $arr
     * @param $length
     * @param bool $preserve_keys
     * @return array
     */
    public static function fw__array_chunk($arr, $length, bool $preserve_keys = false): array
    {
        return array_chunk($arr, $length, $preserve_keys);
    }
    
    /**
     * @param float|int $num
     * @return float|int
     */
    public static function fw__abs($num): float|int
    {
        if(!is_numeric($num)) return $num;
        if(!filter_var($num, FILTER_VALIDATE_INT) && !filter_var($num, FILTER_VALIDATE_FLOAT)) {
            $num = (float)$num;
        }
        return abs($num);
    }
    
    /**
     * @param string $string
     * @return int
     */
    public static function fw__strlen($string): int
    {
        if(!is_string($string)) $string = (string)$string;
        return strlen($string);
    }
    
    /**
     * @param string $string
     * @param string|null $characters
     * @return string
     */
    public static function fw__trim($string, $characters = null): string
    {
        if(!is_string($string)) $string = (string)$string;
        if(empty($characters)) {
            return trim($string);
        } else {
            return trim($string, $characters);
        }
    }
    
    /**
     * @param array $array
     * @param int $offset
     * @param int $length
     * @param bool $preserve_keys
     * @return array
     */
    public static function fw__array_slice($array, $offset, $length = null, $preserve_keys = false): array
    {
        if(!is_array($array)) return $array;
        if(!filter_var($offset, FILTER_VALIDATE_INT) && is_numeric($offset)) {
            $offset = (int)$offset;
        }
        if(is_null($length)) {
            return array_slice($array, $offset);
        } else {
            if(!filter_var($length, FILTER_VALIDATE_INT) && is_numeric($length)) {
                $length = (int)$length;
            }
            return array_slice($array, $offset, $length, $preserve_keys);
        }
    }
    
    /**
     * @param string $string
     * @param int $start
     * @param int $length
     * @param string|null $encoding
     * @return string
     */
    public static function fw__mb_substr($string, $start, $length = 2147483647, ?string $encoding = "UTF-8"): string
    {
        if(!is_string($string)) $string = (string)$string;
        if(is_numeric($length) && !filter_var($length, FILTER_VALIDATE_INT)) $length = (int)$length;
        if(!filter_var($length, FILTER_VALIDATE_INT)) $length = 0;
        return mb_substr($string, $start, $length, $encoding);
    }
    
    /**
     * @param string $string
     * @return string
     */
    public static function fw__urlencode($string): string
    {
        if(!is_string($string)) $string = (string)$string;
        return urlencode($string);
    }
    
    /**
     * @param $string
     * @param $queryStr
     */
    public static function fw__parse_str($string, &$queryStr): void
    {
        if($string === null) $string = '';
        parse_str($string, $queryStr);
    }
    
    /**
     * @param $min
     * @param $max
     * @return int
     */
    public static function fw__rand($min, $max): int
    {
        return rand($min, $max);
    }
    
    /**
     * @param string $pattern
     * @param string $subject
     * @param null|array $matches
     * @param int $flags
     * @param int $offset
     * @return int|false|null
     */
    public static function fw__preg_match($pattern, $subject, &$matches = null, $flags = 0, $offset = 0): bool|int|null
    {
        if(!is_string($pattern)) $pattern = (string)$pattern;
        if(!is_string($subject)) $subject = (string)$subject;
        if(is_numeric($flags) && !filter_var($flags, FILTER_VALIDATE_INT)) $flags = (int)$flags;
        if(is_numeric($offset) && !filter_var($offset, FILTER_VALIDATE_INT)) $offset = (int)$offset;
        return preg_match($pattern, $subject,$matches, $flags, $offset);
    }
    
    /**
     * @param string $pattern
     * @param string $subject
     * @param null|array $matches
     * @param int $flags
     * @param int $offset
     * @return int|false|null
     */
    public static function fw__preg_match_all($pattern, $subject, &$matches = null, $flags = PREG_PATTERN_ORDER, $offset = 0): bool|int|null
    {
        if(!is_string($pattern)) $pattern = (string)$pattern;
        if(!is_string($subject)) $subject = (string)$subject;
        if(is_numeric($flags) && !filter_var($flags, FILTER_VALIDATE_INT)) $flags = (int)$flags;
        if(is_numeric($offset) && !filter_var($offset, FILTER_VALIDATE_INT)) $offset = (int)$offset;
        return preg_match_all($pattern, $subject,$matches, $flags, $offset);
    }
    /**
     * @param string|string[] $pattern
     * @param string|string[] $replacement
     * @param string|string[] $subject
     * @param int $limit [optional]
     * @param int &$count [optional]
     * @return string|string[]|null
     */
    public static function fw__preg_replace($pattern, $replacement, $subject, $limit = -1, &$count=null): array|string|null
    {
        if(is_null($subject))
            $subject = '';
        if(!is_array($pattern) && !is_string($pattern))
            $pattern = (string)$pattern;
        if(!is_array($replacement) && !is_string($replacement))
            $replacement = (string)$replacement;
        return preg_replace($pattern, $replacement, $subject, $limit, $count);
    }

    /**
     * @param string $pattern
     * @param string $subject
     * @param int $limit [optional]
     * @param int $flags [optional]
     * @return string[]|false
     */
    public static function fw__preg_split($pattern, $subject, $limit = -1, $flags = 0): array|bool
    {
        if(is_null($subject))
            $subject = '';
        if(!is_string($pattern)) {
            $pattern = (string)$pattern;
        }
        if(is_numeric($flags) && !filter_var($flags, FILTER_VALIDATE_INT)) {
            $flags = (int)$flags;
        }
        return preg_split($pattern, $subject, $limit, $flags);
    }

    
    /**
     * @param string $file_path
     * @return string|bool
     */

    public static function fw__file_get_contents($file_path): bool|string
    {
        if(empty($file_path)) return false;
    
        $file_path = (string)$file_path;
    
        if(!file_exists($file_path) || is_dir($file_path)) return false;
    
        return file_get_contents($file_path);
    }

    /**
     * @param string $file_path
     * @param string $file_content
     * @return string|bool
     */
    public static function fw__file_put_contents($file_path, $file_content): bool|string
    {
        return file_put_contents($file_path, $file_content );
    }

    
    /**
     * @param $value
     * @return bool
     */
    public static function fw__is_array($value): bool {
        return is_array($value);
    }

    /**
     * @param $array
     * @param $filter_value
     * @param $strict
     * @return array
     */
    public static function fw__array_keys($array, $filter_value = null, $strict = null): array {
        return array_keys($array);
    }

    /**
     * @param $array
     * @param $value
     * @return int
     */
    public static function fw__array_push(&$array, $value): int
    {
        return array_push($array, $value);
    }

    /**
     * @param $to_echo
     * @param $is_debug_echo
     * @return void
     */
    public static function fw__decho($to_echo, $is_debug_echo = true): void{
        if(!defined('IS_DEBUG_ECHO')){
            define('IS_DEBUG_ECHO', true);
        }

        if($is_debug_echo){
            if(is_array($to_echo) || is_object($to_echo)){
                echo PHP_EOL.(ISCLI ? '' : "<pre>").print_r($to_echo, true).(ISCLI ? '' : "</pre>").PHP_EOL;
            } else {
                echo PHP_EOL."$to_echo".PHP_EOL;
            }
        }
    }
}

