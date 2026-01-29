<?php

if (!function_exists('breadcrumbs')) {

    function breadcrumbs()
    {
        $session = session();
        $currentUrl = current_url();
        $currentTitle = breadcrumb_title();

        $trail = $session->get('breadcrumb_trail') ?? [];

        // Evitar duplicados seguidos
        if (empty($trail) || end($trail)['url'] !== $currentUrl) {
            $trail[] = [
                'title' => $currentTitle,
                'url'   => $currentUrl
            ];
        }

        // Máximo 3 niveles
        if (count($trail) > 3) {
            $trail = array_slice($trail, -3);
        }

        $session->set('breadcrumb_trail', $trail);

        return $trail;
    }
}

/* Mapea títulos bonitos */
if (!function_exists('breadcrumb_title')) {

    function breadcrumb_title()
    {
        $uri = service('request')->uri->getPath();

        return match (true) {
            $uri === '/'                   => 'Inicio',
            str_contains($uri, 'carrusel') => 'Carrusel',
            str_contains($uri, 'guardar')  => 'Subir Imagen',
            str_contains($uri, 'crear')    => 'Formulario',
            default                        => 'Página'
        };
    }
}
