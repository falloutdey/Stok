<?php
class RouterHandler {
    public static function handle($router, $uri, $requestMethod) {
        foreach ($router[$requestMethod] as $route => $action) {
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove a correspondência completa
                $action($matches); // Chama a ação passando os parâmetros
                return;
            }
        }
        throw new Exception("Rota não encontrada.");
    }
}