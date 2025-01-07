<?php

namespace Utils;

use Goutte\Client;

class Scraper
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function scrapeTitles(string $url): array
    {
        $crawler = $this->client->request('GET', $url);

        // Extraer los títulos <h1>
        $titles = $crawler->filter('h1')->each(function ($node) {
            return $node->text();
        });

        return $titles;
    }

    public function scrapeLinks(string $url): array
    {
        $crawler = $this->client->request('GET', $url);

        // Extraer todos los enlaces
        $links = $crawler->filter('a')->each(function ($node) {
            return $node->attr('href');
        });

        return $links;
    }


    // Método para extraer el título del producto
    // public function scrapeProductTitle(string $url): ?string
    // {
    //     $crawler = $this->client->request('GET', $url);

    //     // Extraer el título usando la clase CSS 'product-title' para el <h1>
    //     $title = $crawler->filter('h1.product-title')->text();

    //     return $title ?: null;
    // }


    // public function scrapeProductTitle(string $url)
    // {

    //     $url = "https://www.jamila.cl/producto-detalle/cola-fria/5278/cola-fria-500-grs-proarte";
    //     $html = file_get_contents($url);

    //     if ($html === FALSE) {
    //         die('Error al obtener la página');
    //     }

    //     $dom = new \DOMDocument();
    //     libxml_use_internal_errors(true);  // Para evitar advertencias por HTML no válido
    //     $dom->loadHTML($html);
    //     libxml_clear_errors();

    //     $xpath = new \DOMXPath($dom);
    //     $elements = $xpath->query("//h1");  // Buscar todos los <h1>

    //     return $elements;

        
    // }

    public function scrapeProductTitle(string $url) {
        // Usando curl para obtener el contenido de la página

        // $url = "https://www.jamila.cl/producto-detalle/cola-fria/5278/cola-fria-500-grs-proarte";

        $html = file_get_contents($url);

        if ($html === FALSE) {
            die('Error al obtener la página');
        }

        // Cargando el HTML en DOMDocument
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);  // Para evitar advertencias por HTML no válido
        $dom->loadHTML($html);
        libxml_clear_errors();

        // Usando XPath para buscar todos los <h1>
        $xpath = new \DOMXPath($dom);
        $elements = $xpath->query("//h3");  // Buscar todos los <h1>

        if ($elements->length > 0) {
            // Devuelve el contenido de los <h1>
            return $elements->item(0)->nodeValue;
        } else {
            return 'No se encontró el <h1>';
        }
    }
    
}
