<?php
declare(strict_types=1);

namespace App;

final class Router
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function dispatch(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

        // Normaliser les URL avec trailing slash
        if ($uri !== '/' && str_ends_with($uri, '/')) {
            $this->redirect(rtrim($uri, '/'));
            return;
        }

        // Routes
        if ($uri === '/') {
            $this->home();
            return;
        }

        if ($uri === '/sitemap.xml') {
            $this->sitemap();
            return;
        }

        if ($uri === '/contact') {
            if ($method === 'POST') {
                $this->contactSubmit();
            } else {
                $this->contactPage();
            }
            return;
        }

        // Hub communes A–Z
        if ($uri === '/communes') {
            $this->communesHub();
            return;
        }

        // /communes/a ... /communes/z
        if (preg_match('#^/communes/([a-z])$#', $uri, $m)) {
            $this->communesLetter(strtoupper($m[1]));
            return;
        }

        // Pages légales
        if ($uri === '/mentions-legales') {
            $this->staticPage('mentions');
            return;
        }

        if ($uri === '/politique-confidentialite') {
            $this->staticPage('privacy');
            return;
        }

        if ($uri === '/cgu') {
            $this->staticPage('cgu');
            return;
        }

        // Page ville
        if (preg_match('#^/ville/([a-z0-9\-]+)$#', $uri, $m)) {
            $this->cityPage($m[1]);
            return;
        }

        // Pages chauffage (chaudiere-gaz, pompe-a-chaleur, etc.)
        if (preg_match('#^/chauffage/([a-z0-9\-]+)$#', $uri, $m)) {
            $this->heatingPage($m[1]);
            return;
        }

        $this->notFound();
    }

    private function view(): View
    {
        return new View($this->config);
    }

    private function home(): void
    {
        $data = Data::loadCommunes();
        $top = Data::topByPopulation(12);
        $communes = array_slice($data, 0, 24);

        $seo = Seo::forHome($this->config);
        $this->view()->render('home', compact('communes', 'top', 'seo'));
    }

    private function communesHub(): void
    {
        $index = Data::alphaIndex();
        $top = Data::topByPopulation(20);

        $seo = Seo::forCommunesHub($this->config);
        $this->view()->render('communes', compact('index', 'top', 'seo'));
    }

    private function communesLetter(string $letter): void
    {
        $index = Data::alphaIndex();
        $list = $index[$letter] ?? [];

        $seo = Seo::forCommunesLetter($this->config, $letter);
        $this->view()->render('communes_letter', compact('letter', 'list', 'seo'));
    }

    private function cityPage(string $slug): void
    {
        $commune = Data::findCommuneBySlug($slug);
        if (!$commune) {
            $this->notFound();
            return;
        }

        // Cache HTML (uniquement GET sans query string)
        $cache = new Cache($this->config);
        $cacheKey = 'city-' . $slug;

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET' && empty($_SERVER['QUERY_STRING'])) {
            $cached = $cache->get($cacheKey);
            if ($cached !== null) {
                header('Content-Type: text/html; charset=utf-8');
                echo $cached;
                return;
            }

            ob_start();
            $seo = Seo::forCity($this->config, $commune);
            $this->view()->render('city', compact('commune', 'seo'));
            $html = (string)ob_get_clean();

            $cache->set($cacheKey, $html);

            header('Content-Type: text/html; charset=utf-8');
            echo $html;
            return;
        }

        $seo = Seo::forCity($this->config, $commune);
        $this->view()->render('city', compact('commune', 'seo'));
    }

    private function heatingPage(string $slug): void
    {
        $heatingServices = $this->config['heating_services'] ?? [];
        $service = null;
        
        foreach ($heatingServices as $s) {
            if ($s['slug'] === $slug) {
                $service = $s;
                break;
            }
        }
        
        if (!$service) {
            $this->notFound();
            return;
        }

        // Charger les villes
        $communes = Data::loadCommunes();
        $top = Data::topByPopulation(8);

        $seo = [
            'title' => $service['meta_title'] ?? $service['title'],
            'description' => $service['meta_desc'] ?? $service['description'],
            'url' => rtrim($this->config['base_url'] ?? '', '/') . '/chauffage/' . $slug,
            'site_name' => $this->config['site_name'] ?? 'Chauffage-Vosges',
            'brand' => $this->config['brand'] ?? 'Chauffage-Vosges',
        ];

        $this->view()->render('chauffage/service', compact('service', 'communes', 'top', 'seo'));
    }

    private function sitemap(): void
    {
        header('Content-Type: application/xml; charset=utf-8');

        $base = rtrim((string)($this->config['base_url'] ?? ''), '/');
        if ($base === '') {
            // fallback : éviter de générer un sitemap invalide
            $base = 'http://localhost';
        }

        $communes = Data::loadCommunes();
        $now = gmdate('Y-m-d');

        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        // IMPORTANT : tout est en STRING, et virgules bien présentes -> pas de parse error
        $static = [
            ['/', 'weekly', '1.0'],
            ['/communes', 'weekly', '0.9'],
            ['/contact', 'monthly', '0.6'],
            ['/mentions-legales', 'yearly', '0.2'],
            ['/politique-confidentialite', 'yearly', '0.2'],
            ['/cgu', 'yearly', '0.2'],
        ];

        foreach ($static as $row) {
            $path = (string)$row[0];
            $freq = (string)$row[1];
            $prio = (string)$row[2];

            $loc = htmlspecialchars($base . $path, ENT_XML1);
            echo "  <url><loc>{$loc}</loc><lastmod>{$now}</lastmod><changefreq>{$freq}</changefreq><priority>{$prio}</priority></url>\n";
        }

        foreach ($communes as $c) {
            $slug = (string)($c['slug'] ?? '');
            if ($slug === '') continue;

            $loc = htmlspecialchars($base . '/ville/' . $slug, ENT_XML1);
            echo "  <url><loc>{$loc}</loc><lastmod>{$now}</lastmod><changefreq>monthly</changefreq><priority>0.7</priority></url>\n";
        }

        // Pages chauffage
        $heatingServices = $this->config['heating_services'] ?? [];
        foreach ($heatingServices as $s) {
            $slug = (string)($s['slug'] ?? '');
            if ($slug === '') continue;

            $loc = htmlspecialchars($base . '/chauffage/' . $slug, ENT_XML1);
            echo "  <url><loc>{$loc}</loc><lastmod>{$now}</lastmod><changefreq>monthly</changefreq><priority>0.8</priority></url>\n";
        }

        echo "</urlset>";
    }

    private function contactPage(): void
    {
        $seo = Seo::forContact($this->config);

        $city = isset($_GET['ville']) ? trim((string)$_GET['ville']) : '';
        $slug = isset($_GET['slug']) ? trim((string)$_GET['slug']) : '';

        $this->view()->render('contact', compact('seo', 'city', 'slug'));
    }

    private function contactSubmit(): void
    {
        $lead = Lead::fromPost($_POST);

        if (!$lead->isValid()) {
            http_response_code(422);

            $seo = Seo::forContact($this->config);
            $errors = $lead->errors();
            $city = $lead->city;
            $slug = $lead->citySlug;
            $old = $lead->toArray();

            $this->view()->render('contact', compact('seo', 'errors', 'old', 'city', 'slug'));
            return;
        }

        (new LeadStore())->append($lead);
        (new Mailer($this->config))->sendLead($lead);

        $this->redirect('/contact?sent=1');
    }

    private function staticPage(string $name): void
    {
        $seo = Seo::forStatic($this->config, $name);
        $this->view()->render($name, compact('seo'));
    }

    private function notFound(): void
    {
        http_response_code(404);
        $seo = Seo::for404($this->config);
        $this->view()->render('404', compact('seo'));
    }

    private function redirect(string $path): void
    {
        header('Location: ' . $path, true, 301);
        exit;
    }
}