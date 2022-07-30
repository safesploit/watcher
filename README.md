# Watcher

Watcher tracks referrer page, IP address, date/time and user agent data before discreetly redirecting to the indended URL.

<p align="center">
  <!--
  <img width="527" alt="Watcher-Banner" src="https://user-images.githubusercontent.com/10171446/181995197-22277864-c5bf-4b1f-b35e-420d0c0e4e37.png">
  -->

</p>

# Table of Contents

- [Setup](#setup)
  - [Hosting](#hosting)
  - [URL Formatting](#url-formatting)
- [Example log](#example-log)
  - [Watcher v1.1.0](#watcher-v110)
  - [Potential Issues](#potential-issues)
- [Contributors](#contributors)

# Setup

## Hosting

PHP has a [built-in web server](https://www.php.net/manual/en/features.commandline.webserver.php) which can be used to spin up a server immediately for testing purposes.

    $ git clone https://github.com/safesploit/Watcher.git
    $ cd Watcher
    $ php -S localhost:8080 index.php
    
We can now access Watcher via `http://localhost:8080`
    
## URL Formatting

Using the GET variable `s` we can specify the header address to redirect the user to.

    http://localhost:8080/index.php?s=safesploit.com
    
Watcher will log information in `log.txt` and then redirect the user to `http://google.com`.

Alternatively the shorter form `http://localhost:8080/?s=safesploit.com` can be used.

# Example log

`Logged IP address: 127.0.0.1 User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36  Reffered by:  Parameter: safesploit.com Date logged: Friday 29th 2022f July 2022 07:33:38 PM`

## Watcher v1.1.0 
Since v1.1.0 full URLs can be provided via the `s` parameter without significant issue

`Logged IP address: 127.0.0.1, User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36, Referred by: , Parameter: https://www.safesploit.com, Date logged: Saturday 30th 2022f July 2022 05:56:57 PM`

The supplied URL is as follows:

    http://localhost:8080/index.php?s=https://www.safesploit.com


## Potential Issues
Because `www.safesploit.com` will redirect HTTP request to HTTPS the code logic `header( "Location: http://" . $_GET['s'], TRUE, 301 )` works fine.

But for web servers which only use HTTPS and do not redirect HTTP requests issues will occur.

# Programming logic

## Writing to the log file

As of v1.1.0 data is is formatted using the `$data` variable before being written to the log file.

    $data = 
        "Logged IP address: $ip, " .
        "User-Agent: $userAgent, " . 
        "Referred by: $referred, " .
        "Parameter: $param, " .
        "Date logged: $date " .
        "\n";

https://github.com/safesploit/Watcher/blob/cd891a2d70b1e38a53e29f7ba553f3b3941ddaa9/watcher.php#L72

# Contributors

Repositories which inspired and where I used code. 

  - [IP Grabber link](https://github.com/ispeakcomputer/php_visitor_tracking_script)
  - [Shorty](https://github.com/mikecao/shorty) for a future update.
  
