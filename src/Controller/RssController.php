<?php

namespace Watson\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class RssController
{
    public function feedAction(Application $app)
    {
        // Récupération des 15 derniers liens
        $links = $app['dao.link']->findLast(15);

        // Structure de base du flux RSS 2.0
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss/>');
        $xml->addAttribute('version', '2.0');

        $channel = $xml->addChild('channel');
        $channel->addChild('title', 'Watson - Derniers liens');

        // Récupération sécurisée de l’URL de base (via $app["request"] de Silex)
        $request = $app['request'];
        $baseUrl = $request->getSchemeAndHttpHost();

        $channel->addChild('link', $baseUrl . $app['url_generator']->generate('home'));
        $channel->addChild('description', 'Les 15 derniers liens publiés sur Watson');
        $channel->addChild('language', 'fr-fr');

        foreach ($links as $link) {
            $item = $channel->addChild('item');

            // Accès aux données du lien via les getters de l’objet métier Link
            $title = (string) $link->getTitle();
            $url   = (string) $link->getUrl();
            $desc  = (string) $link->getDesc(); // Important : la méthode s’appelle getDesc()

            $item->addChild('title', htmlspecialchars($title));
            $item->addChild('link', htmlspecialchars($url));
            $item->addChild('description', htmlspecialchars($desc));

            // Le champ guid est recommandé en RSS (URL utilisée comme identifiant unique)
            $item->addChild('guid', htmlspecialchars($url));

            // Date de publication (fallback sur la date courante)
            $item->addChild('pubDate', date(DATE_RSS));
        }

        return new Response(
            $xml->asXML(),
            200,
            ['Content-Type' => 'application/rss+xml; charset=UTF-8']
        );
    }
}
