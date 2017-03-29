<?php
function apercuMessage($string)
{
    $regex=array('/http(s?):\/\/([\w]*\.?[\w-]+\.[a-z\.]+)\/?[\w\.-\/]*/',
        '/[\w-.]+@([\w]+)\.[a-z]+/',
        '/#([\w]+)*/');
    $replacement=array('<a href="$0" target="_blank">$0</a>',
        '<a href="mailto:$0" target="_blank">$0</a>',
        '<a href="http://localhost:8080/IUT/micro_blog_smarty/index.php?texteRecherche=$1">$0</a>');
    $result=preg_replace($regex, $replacement, $string);

    return $result;
}