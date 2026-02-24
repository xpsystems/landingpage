(function () {
  /* ── Status URL (injected via data attribute on the script tag) ─── */
  const scriptEl   = document.querySelector("script[data-status-url]");
  const STATUS_URL = scriptEl ? scriptEl.dataset.statusUrl : "";

  /* ── Theme ──────────────────────────────────────────────────────── */
  const THEME_KEY = "xps-theme";

  function getSystemTheme() {
    return window.matchMedia("(prefers-color-scheme: light)").matches ? "light" : "dark";
  }

  function applyTheme(mode) {
    const resolved = mode === "system" ? getSystemTheme() : mode;
    document.documentElement.setAttribute("data-theme", resolved);
    document.querySelectorAll(".theme-btn").forEach(function (btn) {
      btn.classList.toggle("active", btn.dataset.theme === mode);
    });
  }

  function loadTheme() {
    const saved = localStorage.getItem(THEME_KEY) || "system";
    applyTheme(saved);
    return saved;
  }

  let currentTheme = loadTheme();

  /* Re-apply when OS preference changes (only relevant in "system" mode) */
  window.matchMedia("(prefers-color-scheme: light)").addEventListener("change", function () {
    if (currentTheme === "system") applyTheme("system");
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

  /**
   * Maps the API's `overall` field to a UI state.
   * API values: "operational" | "partial_outage" | "major_outage" | "unknown"
   */
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
        method: "GET",
        signal: controller.signal,
        cache:  "no-store",
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