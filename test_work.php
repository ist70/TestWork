<?php
function isCorrect($string)
{
    $stack = [];
    for ($i = 0; $i < strlen($string); $i++) {
        switch ($string[$i]) {
            case '(':
                $stack .= '(';
                break;
            case "{":
                $stack .= '{';
                break;
            case ')':
                if ($stack[strlen($stack) - 1] == '(') {
                    $stack = substr($stack, 0, strlen($stack) - 1);
                }
                break;
            case '}':
                if ($stack[strlen($stack) - 1] == '{') {
                    $stack = substr($stack, 0, strlen($stack) - 1);
                }
                break;
        }
    }

    if (strlen($stack) == 0) {
        var_dump($string);
        echo ' - TRUE <br>';
        return true;
    } else {
        var_dump($string);
        echo ' - FALSE <br>';
        return false;
    }
}

assert(isCorrect('') === true);
assert(isCorrect('()') === true);
assert(isCorrect('{()}') === true);
assert(isCorrect('{()}{}') === true);
assert(isCorrect('(())') === true);
assert(isCorrect('{({({({()})})})}') === true);
assert(isCorrect('{(})') === false);
?>