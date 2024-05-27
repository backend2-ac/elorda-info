<?php
namespace App\Middleware;


use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LanguageRedirectMiddleware
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
    $uri = $request->getUri();
    $path = $uri->getPath();

    $categories = [
        'novosti-stolicy',
        'raznoe',
        'politika',
        'sotsium',
        'ekonomika',
        'sport',
        'kultura',
        'raznoe',
        'mnenie',
        'naznacheniya',
        'geroi-stolicy',
//        'video',
        '30let-nezavisimosti-RK',

        'tseny-v-astane',
        'poslanie',
        'vybory-2023',
        'proisshestvie',
        'tema-dnya',
        'astana-25-1',
        'sluzhba-komplaens',
        'kodeks-etiki',
        'parlament',
        'senat',
        'zasedaniye',
        'akorda',
        'prezident',
        'pravitelstvo',
        'obchestvo' => 'obchestvo',
        'interview',
        'lichnost',
        'obrazovaniye',
        'naznachenie',
        'sluzhu-strane',
        'show-biznes',
    ];
    foreach ($categories as $category) {
        if (strpos($path, $category) !== false) {
            if (strpos($path, '/ru/') === false) {
                $newPath = '/ru' . $path;
                return $response
                    ->withHeader('Location', $newPath)
                    ->withStatus(302);
            }
            break;
        }
    }
    // Проверяем, если URL не содержит язык в начале

    return $next($request, $response);
    }
}
