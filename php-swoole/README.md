## PHP-Swoole on K8S

1. Build a container image for the app: `docker build -t php-swoole:latest .` (for simplicity I just copy index.php)
2. Import the image we built locally into the local cluster: `k3d image import php-swoole:latest`
3. Create the deployment: `kubectl apply -f deployment.yaml`
4. Expose the service: `kubectl apply -f service.yaml`
5. Test the service: `kubectl port-forward svc/php-swoole 8080:8080` (run this on another terminal or in the background with &)
6. Check the output using http client: `curl http://localhost:8080`

Swoole provide a list of configurations, I've left it with the bare minimum, all configurations could be found here: https://www.swoole.co.uk/docs/modules/swoole-server/configuration
