<?php

$errors = [];

function error_message($field, $message)
{
    global $errors;

    isset($errors[$field]) ?
        array_push($errors[$field], $message)
        : $errors[$field] = [$message];
}

// function error_field($field)
// {
//     if (!empty($errors[$field])) :
//         for ($i = 0; $i < count($errors[$field]); $i++) :
//             echo '<p class="text-sm text-danger">' . $errors[$field][$i] . '</p>';
//         endfor;
//     endif;
// }
