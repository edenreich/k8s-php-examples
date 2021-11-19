## PHP-FPM-HTTPD on K8S

1. Build a container image for the app: `docker build -t app:latest .` (for simplicity I just copy index.php)
2. Import the image we built locally into the local cluster: `k3d image import app:latest`
4. Add PHP-FPM and HTTPD configurations: `kubectl apply -f configmap.yaml`
5. Create the deployment: `kubectl apply -f deployment.yaml`
6. Expose the service: `kubectl apply -f service.yaml`
7. Test the service: `kubectl port-forward svc/php-httpd 8080:8080` (run this on another terminal or in the background with &)
8. Check the output using http client: `curl http://localhost:8080`

In httpd.conf all I did is comment back in proxy_fcgi_module and I changed the default listen port from 80 to 8080 so we can run that container as non-root user.
And in httpd-vhosts.conf I've just configured to pass every call to a php file to be proxied to 127.0.0.1:9000 (php-fpm sidecar container).
I also enabled mod_rewrite so we can have all requests mapped to index.php
The rest remains as default.
