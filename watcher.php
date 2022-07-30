<?php
function getIPAddress()
{
    // IP logging
    $register_globals = (bool) ini_get('register_gobals');
    if ($register_globals) 
        $ip = getenv(REMOTE_ADDR);
    else 
        $ip = $_SERVER['REMOTE_ADDR'];

    return $ip;
}

function redirect()
{
    $url = parameterValidator();

    header( "Location: " . $url, TRUE, 301 );
}

function referred()
{
    if(isset($_SERVER['HTTP_REFERER']))
        $referred = $_SERVER['HTTP_REFERER'];
    else
        $referred = "NULL";
}

function parameter()
{
    if (isset($_GET['s']) && $_GET['s'] != "")
        return $_GET['s'];
    else
        exit;
}

function parameterValidator()
{
     //Check if parameter() supplied is URL or URN

    if(filter_var(parameter(), FILTER_VALIDATE_URL))
        $url = parameter();
    else
    {
        $protocol = "http://"; //assuming protocol is HTTP
        $url = $protocol . parameter();
    }

    return $url;
}

function userAgent()
{
    return $_SERVER['HTTP_USER_AGENT'];
}


function watcher()
{
    $logFilename="log.txt"; //log file
    $log=fopen("$logFilename", "a+");
    
    $pattern = "/\btxt\b/i"; // only txt files
    $date=date("l dS of F Y h:i:s A");

    $ip = getIPAddress();
    $userAgent = userAgent();
    $referred = referred();
    $param = parameter();
    

    $data = 
        "Logged IP address: $ip, " .
        "User-Agent: $userAgent, " . 
        "Referred by: $referred, " .
        "Parameter: $param, " .
        "Date logged: $date " .
        "\n";

    if(preg_match($pattern, $logFilename))
        fputs($log, $data);

    fclose($log); //close log

    redirect();
}
?>