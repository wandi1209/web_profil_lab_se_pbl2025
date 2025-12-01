<?php
namespace Polinema\WebProfilLabSe\Core;

class App
{
    protected $routes = [];
    protected $notFoundHandler;

    public function __construct()
    {
        $this->routes = [
            'GET'  => [],
            'POST' => []
        ];
    }

    public function get($uri, $handler)
    {
        $this->routes['GET'][$uri] = $handler;
    }

    public function post($uri, $handler)
    {
        $this->routes['POST'][$uri] = $handler;
    }

    public function put($uri, $handler)
    {
        $this->routes['PUT'][$uri] = $handler;
    }

    public function delete($uri, $handler)
    {
        $this->routes['DELETE'][$uri] = $handler;
    }

    public function notFound($handler)
    {
        $this->notFoundHandler = $handler;
    }

    public function run()
    {
        $requestUri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Hapus base path jika ada
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $requestUri = substr($requestUri, strlen($basePath));
        $requestUri = '/' . ltrim($requestUri, '/');
        
        // Hapus trailing slash (kecuali root /)
        if ($requestUri !== '/' && substr($requestUri, -1) === '/') {
            $requestUri = rtrim($requestUri, '/');
        }

        // Cari route yang cocok
        foreach ($this->routes[$requestMethod] as $route => $handler) {
            // Convert route pattern ke regex
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $requestUri, $matches)) {
                // Filter hanya named parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                // Panggil handler dengan params
                return $this->callAction($handler, array_values($params));
            }
        }

        // Route tidak ditemukan
        if ($this->notFoundHandler) {
            return $this->callAction($this->notFoundHandler, []);
        }

        // Default 404
        http_response_code(404);
        echo "404 - Page Not Found";
    }

    protected function callAction($handler, $params = [])
    {
        // PERBAIKAN: Cek apakah handler adalah Closure
        if ($handler instanceof \Closure) {
            return call_user_func_array($handler, $params);
        }

        // Handler adalah array [Controller::class, 'method']
        if (is_array($handler) && count($handler) === 2) {
            [$controller, $method] = $handler;

            // Instantiate controller
            $controllerInstance = new $controller();

            // Panggil method dengan params
            return call_user_func_array([$controllerInstance, $method], $params);
        }

        throw new \Exception("Invalid route handler format");
    }
}