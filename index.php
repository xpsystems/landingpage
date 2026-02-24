<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$e = fn(string $s): string => htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?= $e($config['brand']['tagline']) ?> — <?= $e($config['brand']['description']) ?>">
<title><?= $e($config['brand']['name']) ?> — <?= $e($config['brand']['tagline']) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="nav-header" id="nav-header">
  <nav class="nav-inner">
    <a href="#" class="nav-logo"><?= $e($config['brand']['name']) ?></a>
    <div class="nav-links" id="nav-links">
      <?php foreach ($config['nav'] as $item): ?>
      <a
        href="<?= $e($item['href']) ?>"
        class="nav-link"
        <?= $item['external'] ? 'target="_blank" rel="noopener noreferrer"' : '' ?>
      ><?= $e($item['label']) ?></a>
      <?php endforeach; ?>
      <span class="status-badge" id="live-status" aria-label="Live service status">
        <span class="status-dot" id="status-dot"></span>
        <span class="status-text" id="status-text">Checking…</span>
      </span>
    </div>
    <button class="nav-hamburger" id="nav-hamburger" aria-label="Toggle navigation" aria-expanded="false">
      <svg class="icon-hamburger" id="icon-menu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <line x1="4" y1="6" x2="20" y2="6"/>
        <line x1="4" y1="12" x2="20" y2="12"/>
        <line x1="4" y1="18" x2="20" y2="18"/>
      </svg>
      <svg class="icon-close" id="icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <line x1="18" y1="6" x2="6" y2="18"/>
        <line x1="6" y1="6" x2="18" y2="18"/>
      </svg>
    </button>
  </nav>
</header>

<main>

  <section class="hero" id="hero">
    <div class="container hero-inner">
      <p class="hero-eyebrow"><?= $e($config['brand']['domains'][0]) ?> / <?= $e($config['brand']['domains'][1]) ?></p>
      <h1 class="hero-title">
        <?= $e($config['brand']['name']) ?>
        <span class="heading-accent-wrap">
          <svg class="heading-accent-svg" viewBox="0 0 260 10" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0,8 Q65,1 130,6 Q195,11 260,4" stroke="#4f8ef7" stroke-width="2.5" fill="none" stroke-linecap="round"/>
          </svg>
        </span>
      </h1>
      <p class="hero-tagline"><?= $e($config['brand']['tagline']) ?></p>
      <p class="hero-description"><?= $e($config['brand']['description']) ?></p>
      <div class="hero-ctas">
        <?php foreach ($config['hero_ctas'] as $cta): ?>
        <a
          href="<?= $e($cta['href']) ?>"
          class="btn <?= $cta['primary'] ? 'btn-primary' : 'btn-secondary' ?>"
          target="_blank"
          rel="noopener noreferrer"
        >
          <?php if (!$cta['primary']): ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="btn-icon">
            <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/>
          </svg>
          <?php else: ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="btn-icon">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
          </svg>
          <?php endif; ?>
          <?= $e($cta['label']) ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="section-divider divider-below">
      <svg viewBox="0 0 1440 70" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,70 L0,35 Q360,0 720,35 Q1080,70 1440,35 L1440,70 Z" fill="#0d0d14"/>
      </svg>
    </div>
  </section>

  <section class="services-section" id="services">
    <div class="container">
      <div class="section-header reveal">
        <h2 class="section-title">
          Services &amp; Partners
          <span class="heading-accent-wrap">
            <svg class="heading-accent-svg" viewBox="0 0 240 10" preserveAspectRatio="none" aria-hidden="true">
              <path d="M0,7 Q60,1 120,6 Q180,11 240,4" stroke="#4f8ef7" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
          </span>
        </h2>
        <p class="section-subtitle">Infrastructure and tools we build, run, and stand behind.</p>
      </div>
      <div class="services-grid">
        <?php foreach ($config['services'] as $i => $service): ?>
        <article
          class="card service-card <?= $service['type'] === 'partner' ? 'card-partner' : '' ?> reveal"
          style="--delay: <?= $i * 80 ?>ms"
        >
          <?php if ($service['type'] === 'partner'): ?>
          <span class="card-badge">Partner</span>
          <?php else: ?>
          <span class="card-badge card-badge-service">Service</span>
          <?php endif; ?>
          <div class="card-top">
            <h3 class="card-name">
              <a href="<?= $e($service['url']) ?>" target="_blank" rel="noopener noreferrer" class="card-name-link">
                <?= $e($service['name']) ?>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="icon-ext">
                  <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                  <polyline points="15 3 21 3 21 9"/>
                  <line x1="10" y1="14" x2="21" y2="3"/>
                </svg>
              </a>
            </h3>
            <p class="card-tagline"><?= $e($service['tagline']) ?></p>
          </div>
          <?php if (!empty($service['links'])): ?>
          <ul class="card-links">
            <?php foreach ($service['links'] as $link): ?>
            <li>
              <a href="<?= $e($link['href']) ?>" target="_blank" rel="noopener noreferrer" class="card-sublink">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="icon-arrow">
                  <line x1="5" y1="12" x2="19" y2="12"/>
                  <polyline points="12 5 19 12 12 19"/>
                </svg>
                <?= $e($link['label']) ?>
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
      <svg viewBox="0 0 1440 70" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,0 L1440,50 L1440,70 L0,70 Z" fill="#0a0a0f"/>
      </svg>
    </div>
  </section>

  <section class="team-section" id="team">
    <div class="container">
      <div class="section-header reveal">
        <h2 class="section-title">
          The Team
          <span class="heading-accent-wrap">
            <svg class="heading-accent-svg" viewBox="0 0 140 10" preserveAspectRatio="none" aria-hidden="true">
              <path d="M0,7 Q35,1 70,6 Q105,11 140,4" stroke="#4f8ef7" stroke-width="2" fill="none" stroke-linecap="round"/>
            </svg>
          </span>
        </h2>
        <p class="section-subtitle">Two developers. One mission.</p>
      </div>
      <div class="team-grid">
        <?php foreach ($config['team'] as $i => $member): ?>
        <article class="card team-card reveal" style="--delay: <?= $i * 120 ?>ms">
          <img class="team-avatar" aria-hidden="true" src="<?= $e($member['img_url']) ?>">
          <h3 class="team-name"><?= $e($member['name']) ?></h3>
          <p class="team-role"><?= $e($member['role']) ?></p>
          <a
            href="<?= $e($member['url']) ?>"
            class="team-link"
            target="_blank"
            rel="noopener noreferrer"
          >
            <?= $e(preg_replace('#^https?://#', '', $member['url'])) ?>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="icon-ext">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
              <polyline points="15 3 21 3 21 9"/>
              <line x1="10" y1="14" x2="21" y2="3"/>
            </svg>
          </a>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="section-divider divider-below">
      <svg viewBox="0 0 1440 70" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,70 L0,20 Q720,70 1440,20 L1440,70 Z" fill="#0d0d14"/>
      </svg>
    </div>
  </section>

  <section class="stats-section" id="stats">
    <div class="container">
      <div class="stats-grid reveal">
        <?php foreach ($config['stats'] as $stat): ?>
        <a href="<?= $e($stat['url']) ?>" class="stat-item" target="_blank" rel="noopener noreferrer">
          <span class="stat-value"><?= $e($stat['value']) ?></span>
          <span class="stat-label"><?= $e($stat['label']) ?></span>
          <span class="stat-cta">
            <?= $e($stat['link_label']) ?>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="icon-arrow-sm">
              <line x1="5" y1="12" x2="19" y2="12"/>
              <polyline points="12 5 19 12 12 19"/>
            </svg>
          </span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>

<footer class="site-footer" id="footer">
  <div class="container footer-inner">
    <div class="footer-brand">
      <span class="footer-logo"><?= $e($config['brand']['name']) ?></span>
      <span class="footer-copy">
        &copy; <?= $config['copyright_year'] ?> <?= $e($config['brand']['name']) ?>. All rights reserved.
      </span>
    </div>
    <nav class="footer-nav" aria-label="Footer navigation">
      <?php foreach ($config['footer_links'] as $link): ?>
      <a href="<?= $e($link['href']) ?>" class="footer-link" target="_blank" rel="noopener noreferrer">
        <?= $e($link['label']) ?>
      </a>
      <?php endforeach; ?>
    </nav>
  </div>
</footer>

<div class="nav-overlay" id="nav-overlay"></div>

<script
  src="script.js"
  defer
  data-status-url="<?= $e($config['status_check_url']) ?>"
></script>
</body>
</html>