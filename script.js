(function () {
  /* ── Status URL (injected via data attribute on the script tag) ─── */
  const scriptEl   = document.querySelector("script[data-status-url]");
  const STATUS_URL = scriptEl ? scriptEl.dataset.statusUrl : "";

  /* ── Preload bar ────────────────────────────────────────────────────
   * The bar element is already in the DOM (written before this script).
   * Phase 1: ramp to ~72% over ~600ms while resources load.
   * Phase 2: snap to 100% on window load, then fade out & remove.
   * ----------------------------------------------------------------- */
  const bar = document.getElementById("preload-bar");

  if (bar) {
    /* Phase 1 — progress fill while page loads */
    requestAnimationFrame(function () {
      bar.style.transition = "width 600ms cubic-bezier(.23,.49,.55,.98)";
      bar.style.width = "72%";
    });

    /* Phase 2 — complete + dismiss on full load */
    function finishBar() {
      bar.classList.add("done");       /* swap to the .done transition */
      bar.style.width   = "100%";
      bar.style.opacity = "0";
      setTimeout(function () {
        if (bar.parentNode) bar.parentNode.removeChild(bar);
      }, 600);
    }

    if (document.readyState === "complete") {
      finishBar();
    } else {
      window.addEventListener("load", finishBar, { once: true });
    }
  }

  /* ── Theme ──────────────────────────────────────────────────────────
   * The initial theme was already applied synchronously in <head>.
   * Here we only wire up the toggle buttons and OS-change listener.
   * ----------------------------------------------------------------- */
  const THEME_KEY = "xps-theme";

  function getSystemTheme() {
    return window.matchMedia("(prefers-color-scheme: light)").matches ? "light" : "dark";
  }

  function applyTheme(mode, animate) {
    /* Broadcast transition: add class so ALL colour/fill/stroke properties
       animate in sync.  Skipped on the silent first-load call (animate ===
       false) so there's no flash from the initial paint.                   */
    if (animate !== false) {
      var html = document.documentElement;
      html.classList.add("is-switching-theme");
      clearTimeout(applyTheme._t);
      applyTheme._t = setTimeout(function () {
        html.classList.remove("is-switching-theme");
      }, 350);
    }

    const resolved = mode === "system" ? getSystemTheme() : mode;
    document.documentElement.setAttribute("data-theme", resolved);
    document.querySelectorAll(".theme-btn").forEach(function (btn) {
      btn.classList.toggle("active", btn.dataset.theme === mode);
    });
  }

  /* Sync button active-state with whatever was set inline in <head> */
  var currentTheme = localStorage.getItem(THEME_KEY) || "system";
  applyTheme(currentTheme, false);   /* silent — no broadcast transition on first paint */

  window.matchMedia("(prefers-color-scheme: light)").addEventListener("change", function () {
    if (currentTheme === "system") applyTheme("system"); /* animated — OS flipped */
  });

  document.querySelectorAll(".theme-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      currentTheme = btn.dataset.theme;
      localStorage.setItem(THEME_KEY, currentTheme);
      applyTheme(currentTheme);
    });
  });

  /* ── Nav hamburger ──────────────────────────────────────────────── */
  const hamburger = document.getElementById("nav-hamburger");
  const navLinks  = document.getElementById("nav-links");
  const overlay   = document.getElementById("nav-overlay");

  function openNav() {
    hamburger.classList.add("open");
    navLinks.classList.add("open");
    overlay.classList.add("active");
    hamburger.setAttribute("aria-expanded", "true");
    document.body.style.overflow = "hidden";
  }

  function closeNav() {
    hamburger.classList.remove("open");
    navLinks.classList.remove("open");
    overlay.classList.remove("active");
    hamburger.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
  }

  hamburger.addEventListener("click", function () {
    navLinks.classList.contains("open") ? closeNav() : openNav();
  });

  overlay.addEventListener("click", closeNav);

  navLinks.querySelectorAll("a.nav-link").forEach(function (link) {
    link.addEventListener("click", function () {
      if (navLinks.classList.contains("open")) closeNav();
    });
  });

  /* ── Scroll-reveal ──────────────────────────────────────────────── */
  const revealObserver = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          revealObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
  );

  document.querySelectorAll(".reveal").forEach(function (el) {
    revealObserver.observe(el);
  });

  /* ── Status check ───────────────────────────────────────────────── */
  const statusDot   = document.getElementById("status-dot");
  const statusText  = document.getElementById("status-text");
  const statusBadge = document.getElementById("status-badge");

  const STATUS_MAP = {
    operational:    { dot: "green",  label: "Operational",    badgeClass: "badge-green"  },
    partial_outage: { dot: "yellow", label: "Partial Outage", badgeClass: "badge-yellow" },
    major_outage:   { dot: "red",    label: "Major Outage",   badgeClass: "badge-red"    },
    unknown:        { dot: "grey",   label: "Unknown",        badgeClass: "badge-grey"   },
  };

  function applyStatus(overall) {
    const state = STATUS_MAP[overall] ?? STATUS_MAP["unknown"];
    statusDot.className   = "status-dot";
    statusBadge.className = "status-badge";
    statusDot.classList.add(state.dot);
    statusBadge.classList.add(state.badgeClass);
    statusText.textContent = state.label;
  }

  async function checkStatus() {
    if (!STATUS_URL) return;
    const controller = new AbortController();
    const timeout = setTimeout(function () { controller.abort(); }, 6000);
    try {
      const res = await fetch(STATUS_URL, {
        method: "GET", signal: controller.signal, cache: "no-store",
      });
      clearTimeout(timeout);
      if (!res.ok) throw new Error("non-ok " + res.status);
      const data    = await res.json();
      const overall = typeof data.overall === "string" ? data.overall : "unknown";
      applyStatus(overall);
    } catch {
      clearTimeout(timeout);
      applyStatus("major_outage");
    }
  }

  checkStatus();

  /* ── Sticky nav border ──────────────────────────────────────────── */
  const navHeader = document.getElementById("nav-header");

  window.addEventListener("scroll", function () {
    navHeader.style.borderBottomColor =
      window.scrollY > 10 ? "rgba(30,30,42,0.9)" : "";
  }, { passive: true });
})();