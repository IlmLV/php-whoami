[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205-8892BF.svg)](https://php.net/)
[![License](https://poser.pugx.org/captainhook/captainhook/license.svg?v=1)](https://packagist.org/packages/captainhook/captainhook)
![GitHub Repo stars](https://img.shields.io/github/stars/IlmLV/php-whoami)

# PHP WHO AM I script
Simple PHP script for request diagnostics. Helps to find out server ip, client ip, request method, scheme, used protocol, user-agent, all request headers.

## Usage
Just copy `public/index.php` file to your desired location and execute as HTTP request.

GET /
```yaml
GET: / HTTP/1.1
IP: 10.0.0.100
Server-IP: 10.0.0.1
Method: GET
Scheme: https
Host: whoami.localhost
Uri: /
Status: 200
Protocol: HTTP/1.1
Time: 1661419537.4819
Authorization: Basic c2Vydmlzcy5pdDpzZXJ2aXNzLml0Cg==
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
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36
X-Https: 1
```

Also, it is possible to request only single attribute response.

GET /?what=ip
```
10.0.0.100
```

It is possible to format response as json.

GET /?format=json
```json
{
  "get" : "/?format=json HTTP/1.1",
  "ip" : "10.0.0.100",
  "server_ip" : "10.0.0.1",
  "method" : "GET",
  "scheme" : "https",
  "host" : "whoami.localhost",
  "uri" : "/?format=json",
  "status" : 200,
  "protocol" : "HTTP/1.1",
  "time" : 1661419537.4819,
  "accept" : "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
  "user_agent" : "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36"
}
```

## License
[MIT](https://choosealicense.com/licenses/mit/)
