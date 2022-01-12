<?php
function create_flash($message, $type = 'success', $client = false)
{
    if (!$client) {
        // create the flash message
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
        return;
    }
    echo "
        <div id='snackbar' class='alert alert-{$type} alert-dismissible fade show' role='alert'>
        {$message}
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>

        <style>
            #snackbar {
                visibility: hidden;
                position: fixed;
                z-index: 1;
                left: 50%;
                transform: translate(-50%, -50%);
                bottom: 4rem;
            }

            #snackbar.show {
                visibility: visible;
            }

        </style>

     
        ";
}


function show_flash()
{

    $flash_session = $_SESSION['flash'] ?? null;

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
    <div id='snackbar' class='alert alert-{$flash_type} alert-dismissible fade show' role='alert'>
    {$flash_message}
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
    </div>

    <style>
        #snackbar {
            visibility: hidden;
            position: fixed;
            z-index: 1;
            left: 50%;
            transform: translate(-50%, -50%);
            bottom: 4rem;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s;
            animation: fadein 0.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }
    </style>
  ";
}

if (isset($_POST['show_flash'])) {
    echo show_flash();
}
