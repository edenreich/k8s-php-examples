## PHP-FPM-NGINX on K8S

1. Build a container image for the app: `docker build -t app:latest .` (for simplicity I just copy index.php)
2. Import the image we built locally into the local cluster: `k3d image import app:latest`
3. Add PHP-FPM and NGINX configurations: `kubectl apply -f configmap.yaml`
4. Create the deployment: `kubectl apply -f deployment.yaml`
5. Expose the service: `kubectl apply -f service.yaml`
6. Test the service: `kubectl port-forward svc/php-nginx 8080:8080` (run this on another terminal or in the background with &)
7. Check the output using http client: `curl http://localhost:8080`

In nginx.conf I've changed the target of the logs, errors I send to stderr and normal logs I send to stdout.
In nginx-vhosts.conf I've just configured to pass every call to a php file to be proxied to 127.0.0.1:9000 (php-fpm sidecar container).
The rest remains as default.
