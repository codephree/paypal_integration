<?php


if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != "" )
{
    // Finally, destroy the session.
    session_destroy();
    header("Location: form.php");
} else {
    header("Location: form.php");
}