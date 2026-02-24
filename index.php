<?php
$config = [
    'brand' => [
        'name'        => 'xpsystems',
        'tagline'     => 'German Web-Provider',
        'description' => 'European infrastructure, digital sovereignty, and developer-first tooling — built and operated from Germany.',
        'domains'     => ['xpsystems.eu', 'xpsystems.de'],
        'version'     => '3.2.1',
    ],
    'nav' => [
        ['label' => 'Services', 'href' => '#services', 'external' => false],
        ['label' => 'Team',     'href' => '#team',     'external' => false],
        ['label' => 'Status',   'href' => 'https://status.xpsystems.eu', 'external' => true],
        ['label' => 'GitHub',   'href' => 'https://github.com/xpsystems', 'external' => true],
    ],
    'hero_ctas' => [
        [
            'label'   => 'GitHub',
            'href'    => 'https://github.com/xpsystems',
            'primary' => false,
        ],
        [
            'label'   => 'System Status',
            'href'    => 'https://status.xpsystems.eu',
            'primary' => true,
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
                ['label' => 'getmy.name',      'href' => 'https://getmy.name'],
                ['label' => 'status.mtex.dev', 'href' => 'https://status.mtex.dev'],
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
            'name'    => 'Fabian Ternis',
            'role'    => 'Founder / Web Dev',
            'url'     => 'https://fabianternis.dev',
            'img_url' => 'https://github.com/michaelninder.png',
        ],
        [
            'name'    => 'Ramsay Brewer',
            'role'    => 'Developer',
            'url'     => 'https://dogwaterdev.de',
            'img_url' => 'https://github.com/dogwaterdev.png',
        ],
    ],
    'stats' => [
        [
            'value'      => '100+',
            'label'      => 'Domains Managed',
            'url'        => 'https://domainlist.fabianternis.de',
            'link_label' => 'View domain list',
        ],
        [
            'value'      => 'Live',
            'label'      => 'Infrastructure Monitored',
            'url'        => 'https://status.xpsystems.eu',
            'link_label' => 'View system status',
        ],
        [
            'value'      => 'Open',
            'label'      => 'Source Projects',
            'url'        => 'https://github.com/xpsystems',
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

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($config['brand']['name']) ?> — <?= e($config['brand']['tagline']) ?></title>
  <meta name="description" content="<?= e($config['brand']['description']) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- ① Theme bootstrap — runs sync before first paint to prevent flash -->
  <script>
  (function(){
    try {
      var s = localStorage.getItem('xps-theme') || 'system';
      var r = s === 'system'
        ? (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark')
        : s;
      document.documentElement.setAttribute('data-theme', r);
    } catch(e) {}
  })();
  </script>

  <!-- ② Preload bar — inline so it paints before external CSS arrives -->
  <style>
  #preload-bar {
    position: fixed;
    top: 0; left: 0;
    width: 0%;
    height: 3px;
    z-index: 9999;
    pointer-events: none;
    background: linear-gradient(90deg, #4f8ef7 0%, #7ab5fa 60%, #a8d0ff 100%);
    box-shadow: 0 0 10px rgba(79,142,247,.7), 0 0 20px rgba(79,142,247,.3);
    border-radius: 0 2px 2px 0;
    /* progress driven by JS; transition set per-phase */
    will-change: width, opacity;
  }
  [data-theme="light"] #preload-bar {
    background: linear-gradient(90deg, #2e6ee6 0%, #5590f5 60%, #84b4ff 100%);
    box-shadow: 0 0 10px rgba(46,110,230,.6), 0 0 20px rgba(46,110,230,.25);
  }
  #preload-bar.done {
    transition: width .25s cubic-bezier(.23,.49,.55,.98),
                opacity .4s ease .1s;
  }
  </style>

  <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="preload-bar"></div>

<!-- NAV -->
<header class="nav-header" id="nav-header">
  <div class="nav-inner">
    <a href="/" class="nav-logo"><?= e($config['brand']['name']) ?></a>

    <nav class="nav-links" id="nav-links" aria-label="Main navigation">
      <?php foreach ($config['nav'] as $item): ?>
        <a
          class="nav-link"
          href="<?= e($item['href']) ?>"
          <?= $item['external'] ? 'target="_blank" rel="noopener noreferrer"' : '' ?>
        ><?= e($item['label']) ?></a>
      <?php endforeach; ?>

      <span class="status-badge" id="status-badge" title="Live infrastructure status">
        <span class="status-dot" id="status-dot"></span>
        <span class="status-text" id="status-text">Checking…</span>
      </span>
    </nav>

    <button
      class="nav-hamburger"
      id="nav-hamburger"
      aria-label="Toggle navigation"
      aria-expanded="false"
      aria-controls="nav-links"
    >
      <svg class="icon-hamburger" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
      <svg class="icon-close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>
</header>

<div class="nav-overlay" id="nav-overlay"></div>

<!-- HERO -->
<section class="hero">
  <div class="container hero-inner">
    <p class="hero-eyebrow reveal"><?= e($config['brand']['domains'][0]) ?> / <?= e($config['brand']['domains'][1]) ?></p>
    <h1 class="hero-title reveal" style="--delay:60ms"><?= e($config['brand']['name']) ?></h1>
    <p class="hero-tagline reveal" style="--delay:120ms"><?= e($config['brand']['tagline']) ?></p>
    <p class="hero-description reveal" style="--delay:180ms"><?= e($config['brand']['description']) ?></p>
    <div class="hero-ctas reveal" style="--delay:240ms">
      <?php foreach ($config['hero_ctas'] as $cta): ?>
        <a
          href="<?= e($cta['href']) ?>"
          class="btn <?= $cta['primary'] ? 'btn-primary' : 'btn-secondary' ?>"
          target="_blank"
          rel="noopener noreferrer"
        >
          <?php if (!$cta['primary']): ?>
            <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.009-.868-.014-1.703-2.782.605-3.369-1.34-3.369-1.34-.454-1.154-1.11-1.462-1.11-1.462-.907-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.578 9.578 0 0 1 12 6.836a9.59 9.59 0 0 1 2.504.337c1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.741 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z"/>
            </svg>
          <?php endif; ?>
          <?= e($cta['label']) ?>
          <?php if ($cta['primary']): ?>
            <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,0 C360,70 1080,70 1440,0 L1440,70 L0,70 Z" class="divider-fill-alt"/>
    </svg>
  </div>
</section>

<!-- SERVICES -->
<section class="services-section" id="services">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">Services &amp; Partners</h2>
      <p class="section-subtitle reveal" style="--delay:60ms">Infrastructure and tools we build, run, and stand behind.</p>
    </div>

    <div class="services-grid">
      <?php foreach ($config['services'] as $i => $service): ?>
        <article
          class="card <?= $service['type'] === 'partner' ? 'card-partner' : '' ?> reveal"
          style="--delay:<?= $i * 60 ?>ms"
        >
          <span class="card-badge <?= $service['type'] === 'service' ? 'card-badge-service' : '' ?>">
            <?= $service['type'] === 'partner' ? 'Partner' : 'Service' ?>
          </span>

          <div class="card-top">
            <h3 class="card-name">
              <a class="card-name-link" href="<?= e($service['url']) ?>" target="_blank" rel="noopener noreferrer">
                <?= e($service['name']) ?>
                <svg class="icon-ext" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
              </a>
            </h3>
            <p class="card-tagline"><?= e($service['tagline']) ?></p>
          </div>

          <?php if (!empty($service['links'])): ?>
            <ul class="card-links">
              <?php foreach ($service['links'] as $link): ?>
                <li>
                  <a class="card-sublink" href="<?= e($link['href']) ?>" target="_blank" rel="noopener noreferrer">
                    <svg class="icon-arrow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                    <?= e($link['label']) ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider divider-below">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,70 C360,0 1080,0 1440,70 L1440,70 L0,70 Z" class="divider-fill-bg"/>
    </svg>
  </div>
</section>

<!-- TEAM -->
<section class="team-section" id="team">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title reveal">The Team</h2>
      <p class="section-subtitle reveal" style="--delay:60ms">Two developers. One mission.</p>
    </div>

    <div class="team-grid">
      <?php foreach ($config['team'] as $i => $member): ?>
        <article class="card team-card reveal" style="--delay:<?= $i * 80 ?>ms">
          <div class="team-avatar-wrap">
            <img
              class="team-avatar-img"
              src="<?= e($member['img_url']) ?>"
              alt="<?= e($member['name']) ?>"
              width="80"
              height="80"
              loading="lazy"
              onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
            >
            <div class="team-avatar-fallback" aria-hidden="true">
              <?= e(mb_strtoupper(mb_substr($member['name'], 0, 1))) ?>
            </div>
          </div>

          <h3 class="team-name"><?= e($member['name']) ?></h3>
          <p class="team-role"><?= e($member['role']) ?></p>

          <a class="team-link" href="<?= e($member['url']) ?>" target="_blank" rel="noopener noreferrer">
            Portfolio
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" width="13" height="13">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
          </a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section-divider divider-below">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,0 C360,70 1080,70 1440,0 L1440,70 L0,70 Z" class="divider-fill-alt"/>
    </svg>
  </div>
</section>

<!-- STATS -->
<section class="stats-section">
  <div class="container">
    <div class="stats-grid">
      <?php foreach ($config['stats'] as $i => $stat): ?>
        <a class="stat-item reveal" href="<?= e($stat['url']) ?>" target="_blank" rel="noopener noreferrer" style="--delay:<?= $i * 60 ?>ms">
          <span class="stat-value"><?= e($stat['value']) ?></span>
          <span class="stat-label"><?= e($stat['label']) ?></span>
          <span class="stat-cta">
            <?= e($stat['link_label']) ?>
            <svg class="icon-arrow-sm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="site-footer">
  <div class="container footer-inner">

    <div class="footer-brand">
      <span class="footer-logo"><?= e($config['brand']['name']) ?></span>
      <span class="footer-copy">&copy; <?= $config['copyright_year'] ?>. All rights reserved.</span>
      <span class="footer-version">v<?= e($config['brand']['version']) ?></span>
    </div>

    <div class="footer-right">
      <nav class="footer-nav" aria-label="Footer navigation">
        <?php foreach ($config['footer_links'] as $link): ?>
          <a class="footer-link" href="<?= e($link['href']) ?>" target="_blank" rel="noopener noreferrer">
            <?= e($link['label']) ?>
          </a>
        <?php endforeach; ?>
      </nav>

      <!-- Theme toggle: system / dark / light -->
      <div class="theme-toggle" role="group" aria-label="Color theme">
        <button class="theme-btn" data-theme="system" title="System theme" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="2" y="3" width="20" height="14" rx="2"/>
            <line x1="8" y1="21" x2="16" y2="21"/>
            <line x1="12" y1="17" x2="12" y2="21"/>
          </svg>
        </button>
        <button class="theme-btn" data-theme="dark" title="Dark theme" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
          </svg>
        </button>
        <button class="theme-btn" data-theme="light" title="Light theme" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="5"/>
            <line x1="12" y1="1" x2="12" y2="3"/>
            <line x1="12" y1="21" x2="12" y2="23"/>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
            <line x1="1" y1="12" x2="3" y2="12"/>
            <line x1="21" y1="12" x2="23" y2="12"/>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
          </svg>
        </button>
      </div>
    </div>

  </div>
</footer>

<script src="script.js" data-status-url="<?= e($config['status_check_url']) ?>" defer></script>

</body>
</html>