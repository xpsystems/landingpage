(function () {
  const scriptEl = document.querySelector("script[data-status-url]");
  const STATUS_URL = scriptEl ? scriptEl.dataset.statusUrl : "";

  const hamburger = document.getElementById("nav-hamburger");
  const navLinks = document.getElementById("nav-links");
  const overlay = document.getElementById("nav-overlay");

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
    if (navLinks.classList.contains("open")) {
      closeNav();
    } else {
      openNav();
    }
  });

  overlay.addEventListener("click", closeNav);

  navLinks.querySelectorAll("a.nav-link").forEach(function (link) {
    link.addEventListener("click", function () {
      if (navLinks.classList.contains("open")) {
        closeNav();
      }
    });
  });

  const revealEls = document.querySelectorAll(".reveal");

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

  revealEls.forEach(function (el) {
    revealObserver.observe(el);
  });

  const statusDot = document.getElementById("status-dot");
  const statusText = document.getElementById("status-text");

  async function checkStatus() {
    if (!STATUS_URL) return;

    const controller = new AbortController();
    const timeout = setTimeout(function () {
      controller.abort();
    }, 6000);

    try {
      const res = await fetch(STATUS_URL, {
        method: "GET",
        signal: controller.signal,
        cache: "no-store",
      });

      clearTimeout(timeout);

      if (res.ok) {
        statusDot.classList.add("green");
        statusDot.classList.remove("red");
        statusText.textContent = "Operational";
      } else {
        throw new Error("non-ok");
      }
    } catch {
      clearTimeout(timeout);
      statusDot.classList.add("red");
      statusDot.classList.remove("green");
      statusText.textContent = "Degraded";
    }
  }

  checkStatus();

  const navHeader = document.getElementById("nav-header");
  let lastScroll = 0;

  window.addEventListener(
    "scroll",
    function () {
      const current = window.scrollY;
      if (current > 10) {
        navHeader.style.borderBottomColor = "rgba(30,30,42,0.9)";
      } else {
        navHeader.style.borderBottomColor = "";
      }
      lastScroll = current;
    },
    { passive: true }
  );
})();