## Deploy PHP with K8S

This repository is meant for showing a few simple examples of different combinations of PHP web-servers.

* php-fpm proxied by httpd
* php-fpm proxied by nginx 
* php with swoole

Unlike other languages in the PHP community the prefered approach was to NOT implement a web-server, instead reuse that what already exists.
This IMO makes it a bit more difficult to package, but on the other hand you get all the security benefits of well known and maintain web-servers like apache and nginx.
Alternativly some people in the PHP community would prefer to run php using swoole, which is a web-server implemented in C and written as an extension for PHP, also pretty powerful. 

In order to deploy these bundles I'm going to use k3d which is a minimalist binary for spining up a local kubernetes cluster using docker containers.
I will write all of these manfiests to be compatible for kubernetes version v1.21.1
I'm going to use non-modified publicly available docker images mainted by the PHP community, just to keep things simple.


To spin-up a cluster I'll use the following command:
```sh
k3d cluster create --agents 3
```


