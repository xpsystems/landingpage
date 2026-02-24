<?php

$config = [
    'brand' => [
        'name'        => 'xpsystems',
        'tagline'     => 'German Web-Provider',
        'description' => 'European infrastructure, digital sovereignty, and developer-first tooling — built and operated from Germany.',
        'domains'     => ['xpsystems.eu', 'xpsystems.de'],
        'version'     => '3.2.2',
    ],
    'nav' => [
        ['label' => 'Services', 'href' => '#services', 'external' => false],
        ['label' => 'Team',     'href' => '#team',     'external' => false],
        ['label' => 'Status',   'href' => 'https://status.xpsystems.eu', 'external' => true],
        ['label' => 'GitHub',   'href' => 'https://github.com/xpsystems', 'external' => true],
    ],
    'hero_ctas' => [
        [
            'label'    => 'GitHub',
            'href'     => 'https://github.com/xpsystems',
            'primary'  => false,
        ],
        [
            'label'    => 'System Status',
            'href'     => 'https://status.xpsystems.eu',
            'primary'  => true,
        ],
    ],
    'services' => [
        [
            'name'    => 'EuropeHost.eu',
            'type'    => 'service',
            'url'     => 'https://europehost.eu',
            'tagline' => 'European hosting infrastructure',
            'links'   => [
                ['label' => 'eudomains.eu',  'href' => 'https://eudomains.eu'],
                ['label' => 'eushare.eu',    'href' => 'https://eushare.eu'],
                ['label' => 'dsc.pics',      'href' => 'https://dsc.pics'],
                ['label' => 'swiftshare.eu', 'href' => 'https://swiftshare.eu'],
            ],
        ],
        [
            'name'    => 'eu-data.org',
            'type'    => 'service',
            'url'     => 'https://eu-data.org',
            'tagline' => 'European Digital Sovereignty — GDPR-compliant alternatives',
            'links'   => [
                ['label' => 'mail-free.eu',  'href' => 'https://mail-free.eu'],
                ['label' => 'eu-search.org', 'href' => 'https://eu-search.org'],
            ],
        ],
        [
            'name'    => 'MTEX.dev',
            'type'    => 'partner',
            'url'     => 'https://mtex.dev',
            'tagline' => 'Building the tools we actually want to use',
            'links'   => [
                ['label' => 'getmy.name',       'href' => 'https://getmy.name'],
                ['label' => 'status.mtex.dev',  'href' => 'https://status.mtex.dev'],
            ],
        ],
        [
            'name'    => 'api-sandbox.de',
            'type'    => 'service',
            'url'     => 'https://api-sandbox.de',
            'tagline' => 'API development sandbox',
            'links'   => [],
        ],
        [
            'name'    => 'xpsys.eu',
            'type'    => 'service',
            'url'     => 'https://xpsys.eu',
            'tagline' => 'Gateway for services & templates',
            'links'   => [],
        ],
    ],
    'team' => [
        [
            'name' => 'Fabian Ternis',
            'role' => 'Founder / Web Dev',
            'url'  => 'https://fabianternis.dev',
            'img_url' => 'https://github.com/michaelninder.png',
        ],
        [
            'name' => 'Ramsay Brewer',
            'role' => 'Developer',
            'url'  => 'https://dogwaterdev.de',
            'img_url' => 'https://github.com/dogwaterdev.png',
        ],
    ],
    'stats' => [
        [
            'value'    => '100+',
            'label'    => 'Domains Managed',
            'url'      => 'https://domainlist.fabianternis.de',
            'link_label' => 'View domain list',
        ],
        [
            'value'    => 'Live',
            'label'    => 'Infrastructure Monitored',
            'url'      => 'https://status.xpsystems.eu',
            'link_label' => 'View system status',
        ],
        [
            'value'    => 'Open',
            'label'    => 'Source Projects',
            'url'      => 'https://github.com/xpsystems',
            'link_label' => 'Browse on GitHub',
        ],
    ],
    'footer_links' => [
        ['label' => 'GitHub',      'href' => 'https://github.com/xpsystems'],
        ['label' => 'Status',      'href' => 'https://status.xpsystems.eu'],
        ['label' => 'EuropeHost',  'href' => 'https://europehost.eu'],
        ['label' => 'eu-data.org', 'href' => 'https://eu-data.org'],
        ['label' => 'MTEX.dev',    'href' => 'https://mtex.dev'],
    ],
    'status_check_url' => 'https://status.xpsystems.eu/api/status',
    'copyright_year'   => (int) date('Y'),
];