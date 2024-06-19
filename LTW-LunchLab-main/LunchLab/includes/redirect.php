<?php

function redirect_login($message_type, $message_content)
{
    if ($message_type == 'error')
        $_SESSION['draw'] = 'login';

    redirect($message_type, $message_content);
}

function redirect_signup($message_type, $message_content)
{
    if ($message_type == 'error')
        $_SESSION['draw'] = 'signup';

    redirect($message_type, $message_content);
}

function redirect($message_type, $message_content)
{
    $_SESSION['messages'][] = array('type' => $message_type, 'content' => $message_content);

    if (isset($_SERVER['HTTP_REFERER']))
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    else
        header('Location: ../index.php');
}
