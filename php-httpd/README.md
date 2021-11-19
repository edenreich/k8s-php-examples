## PHP-FPM-HTTPD on K8S

1. docker build -t app:latest .
2. k3d image import app:latest
4. kubectl apply -f configmap.yaml
5. kubectl apply -f deployment.yaml

In httpd.conf all I did is comment back in proxy_fcgi_module and I changed the default listen port from 80 to 8080 so we can run that container as non-root user.
And in httpd-vhosts.conf I've just configured to pass every call to a php file to be proxied to localhost:9000 (php-fpm sidecar container).