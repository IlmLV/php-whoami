[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/captainhook/captainhook/license.svg?v=1)](https://packagist.org/packages/captainhook/captainhook)
![GitHub Repo stars](https://img.shields.io/github/stars/IlmLV/php-whoami)

# PHP WHO AM I script
Simple PHP script for request diagnostics.

## Usage
Just copy whoami.php file to your desired location and execute as HTTP request.

GET /whoamip.php
```yaml
GET: /whoami/ HTTP/1.1
IP: 10.0.0.100
Server-IP: 10.0.0.1
Method: GET
Scheme: https
Status: 200
Protocol: HTTP/1.1
Time: 1661419537.4819
TZ: Europe/Riga
Host: whoami.localhost
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Accept-Encoding: gzip, deflate, br
Accept-Language: en-US,en;q=0.9,ru;q=0.8,lv;q=0.7,fr;q=0.6
Cache-Control: max-age=0
Connection: keep-alive
Cookie: new_cookie=1; new_cookie2=true
Sec-Ch-Ua: "Chromium";v="104", " Not A;Brand";v="99", "Google Chrome";v="104"
Sec-Ch-Ua-Mobile: ?0
Sec-Ch-Ua-Platform: "Windows"
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: none
Sec-Fetch-User: ?1
Upgrade-Insecure-Requests: 1
X-Https: 1
```

Also, it is possible to request only single attribute response.

GET /whoamip.php?what=ip
```
10.0.0.100
```

## Limitations
Currently only supports HTTP requests, no CLI support.

## License
[MIT](https://choosealicense.com/licenses/mit/)