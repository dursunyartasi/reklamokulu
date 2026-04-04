<?php

class Router
{
    private array $routes = [];

    public function get(string $path, string $controller, string $method): void
    {
        $this->routes['GET'][$path] = [$controller, $method];
    }

    public function post(string $path, string $controller, string $method): void
    {
        $this->routes['POST'][$path] = [$controller, $method];
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = '/' . trim(parse_url($uri, PHP_URL_PATH), '/');
        $method = strtoupper($method);

        // Direkt eslesme
        if (isset($this->routes[$method][$uri])) {
            $this->call($this->routes[$method][$uri]);
            return;
        }

        // Dinamik parametreli eslesme
        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            $pattern = preg_replace('/\{([a-z_]+)\}/', '(?P<$1>[^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $this->call($handler, $params);
                return;
            }
        }

        // 404
        http_response_code(404);
        require __DIR__ . '/views/layouts/404.php';
    }

    private function call(array $handler, array $params = []): void
    {
        [$controllerClass, $method] = $handler;

        $controllerFile = __DIR__ . "/controllers/{$controllerClass}.php";
        if (!file_exists($controllerFile)) {
            die("Controller bulunamadi: {$controllerClass}");
        }

        require_once $controllerFile;
        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            die("Method bulunamadi: {$controllerClass}::{$method}");
        }

        call_user_func_array([$controller, $method], $params);
    }
}