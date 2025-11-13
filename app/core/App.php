<?php
namespace Polinema\WebProfilLabSe\Core;

class App {
    
    // Array untuk menyimpan semua rute
    protected $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => []
    ];

    protected $notFoundHandler;

    /**
     * Metode untuk mendaftarkan rute GET
     */
    public function get($uri, $action) {
        $uri = $this->normalizeUri($uri);
        $this->routes['GET'][$uri] = $action;
    }

    /**
     * Metode untuk mendaftarkan rute POST
     */
    public function post($uri, $action) {
        $uri = $this->normalizeUri($uri);
        $this->routes['POST'][$uri] = $action;
    }

    /**
     * Metode untuk mendaftarkan rute PUT
     */
    public function put($uri, $action) {
        $uri = $this->normalizeUri($uri);
        $this->routes['PUT'][$uri] = $action;
    }

    /**
     * Metode untuk mendaftarkan rute DELETE
     */
    public function delete($uri, $action) {
        $uri = $this->normalizeUri($uri);
        $this->routes['DELETE'][$uri] = $action;
    }

    /**
     * Mendaftarkan handler 404
     */
    public function notFound($action) {
        $this->notFoundHandler = $action;
    }

    /**
     * Menjalankan router untuk mencocokkan rute
     */
    public function run() {
        $uri = $this->getCurrentUri();
        
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $httpMethod = strtoupper($_POST['_method']);
        } else {
            $httpMethod = $requestMethod;
        }

        // Cek apakah ada rute yang cocok untuk metode tersebut
        if (isset($this->routes[$httpMethod])) {
            foreach ($this->routes[$httpMethod] as $route => $action) {
            
                // Ubah rute menjadi regex untuk parameter (cth: /user/{id})
                $regexRoute = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
                $regexRoute = '#^' . $regexRoute . '$#';

                $params = [];
                // Cek apakah URI saat ini cocok dengan regex rute
                if (preg_match($regexRoute, $uri, $params)) {
                    // Hapus string lengkap (cocokan pertama)
                    array_shift($params); 
                    
                    // Panggil aksi (controller) dengan parameter
                    $this->callAction($action, $params);
                    return; // Rute ditemukan, berhenti
                }
            }
        }

        // Jika loop selesai dan tidak ada rute, panggil 404
        if ($this->notFoundHandler) {
            $this->callAction($this->notFoundHandler);
        } else {
            http_response_code(404);
            echo "404 Not Found (Handler not defined)";
        }
    }

    /**
     * Helper untuk memanggil Controller dan Method
     */
    protected function callAction($action, $params = []) {
        $controllerName = $action[0];
        $methodName = $action[1];

        // Buat instance controller
        $controller = new $controllerName();

        // Panggil method controller, kirimkan parameter dari URL
        call_user_func_array([$controller, $methodName], $params);
    }

    /**
     * Helper untuk mengambil URI saat ini dari $_GET['url']
     */
    protected function getCurrentUri() {
        $uri = $_GET['url'] ?? '';
        return $this->normalizeUri($uri);
    }

    /**
     * Helper untuk memastikan URI punya format yang konsisten
     * (diawali / dan tanpa / di akhir)
     */
    protected function normalizeUri($uri) {
        $uri = rtrim($uri, '/');
        
        if (empty($uri)) {
            return '/';
        }

        if ($uri[0] !== '/') {
            $uri = '/' . $uri;
        }

        return $uri;
    }
}