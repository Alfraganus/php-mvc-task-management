<?php
//Simple page redirect

function redirect($page)
{
        $string = '<script type="text/javascript">';
        $string .= 'window.location = "' . URLROOT.$page . '"';
        $string .= '</script>';
        echo  $string;

}
