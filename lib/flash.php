<?php
function create_flash($message, $type = 'success')
{
    // create the flash message
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function show_flash()
{

    $flash_session = $_SESSION['flash'] ? $_SESSION['flash'] : null;

    if (!isset($flash_session)) {
        return;
    }

    // get flash message
    $flash_message = $flash_session['message'];

    // get flash type
    $flash_type = $flash_session['type'];

    // remove the flash messages
    $_SESSION['flash'] = null;


    echo "
    <div class='alert alert-{$flash_type} alert-dismissible fade show' role='alert'>
    {$flash_message}
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
    </div>
  ";
}
