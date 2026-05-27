const revealItems = document.querySelectorAll(
  ".reveal, .reveal-left, .reveal-right, .reveal-scale, .reveal-fade",
);

const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      entry.target.classList.toggle("visible", entry.isIntersecting);
    });
  },
  { threshold: 0.16 },
);

revealItems.forEach((item) => observer.observe(item));

const getCurrentPageFile = () => {
  const pathname = window.location.pathname;
  const file = pathname.substring(pathname.lastIndexOf("/") + 1);
  return file || "index.html";
};

const syncSharedNavigationAndFooter = () => {
  const currentPage = getCurrentPageFile();
  const isHomePage = currentPage === "index.html";

  const pageKeyMap = {
    "index.html": "home",
    "about.html": "about",
    "menu.html": "menu",
    "complete-menu.html": "menu",
    "menu-detail.html": "menu",
    "complete-menu-detail.html": "menu",
    "cart.html": "menu",
    "checkout.html": "menu",
    "cards-page.html": "privilege",
    "privilege-card.html": "privilege",
    "contact.html": "contact",
    "review.html": "reviews",
  };

  const activeKey = pageKeyMap[currentPage] || "";

  const navItems = [
    {
      key: "home",
      label: "Home",
      homeHref: "#home",
      otherHref: "index.html#home",
    },
    {
      key: "about",
      label: "About",
      homeHref: "about.html",
      otherHref: "about.html",
    },
    {
      key: "menu",
      label: "Menu",
      homeHref: "menu.html",
      otherHref: "menu.html",
    },
    {
      key: "privilege",
      label: "Card",
      homeHref: "cards-page.html",
      otherHref: "cards-page.html",
    },
    {
      key: "reviews",
      label: "Reviews",
      homeHref: "review.html",
      otherHref: "review.html",
    },
    {
      key: "contact",
      label: "Contact",
      homeHref: "contact.html",
      otherHref: "contact.html",
    },
  ];

  const quickLinks = [
    {
      label: "Home",
      homeHref: "#home",
      otherHref: "index.html#home",
    },
    {
      label: "about",
      homeHref: "about.html",
      otherHref: "about.html",
    },
    {
      label: "menu",
      homeHref: "menu.html",
      otherHref: "menu.html",
    },
    {
      label: "card",
      homeHref: "cards-page.html",
      otherHref: "cards-page.html",
    },
    {
      label: "contact",
      homeHref: "contact.html",
      otherHref: "contact.html",
    },
  ];

  const desktopNav = document.querySelector(".desktop-nav");
  if (desktopNav) {
    desktopNav.innerHTML = navItems
      .map((item) => {
        const href = isHomePage ? item.homeHref : item.otherHref;
        const activeClass = item.key === activeKey ? " active" : "";
        const ariaCurrent =
          item.key === activeKey ? ' aria-current="page"' : "";
        return `<li class="nav-item"><a class="nav-link${activeClass}"${ariaCurrent} href="${href}">${item.label}</a></li>`;
      })
      .join("");
  }

  const sideNav = document.querySelector("#mobileMenu .side-nav");
  if (sideNav) {
    sideNav.innerHTML = navItems
      .map((item) => {
        const href = isHomePage ? item.homeHref : item.otherHref;
        const activeClass = item.key === activeKey ? " active" : "";
        const ariaCurrent =
          item.key === activeKey ? ' aria-current="page"' : "";
        return `<li class="nav-item"><a data-bs-dismiss="offcanvas" class="nav-link${activeClass}"${ariaCurrent} href="${href}">${item.label}</a></li>`;
      })
      .join("");
  }

  const quickLinksHeading = Array.from(
    document.querySelectorAll(".footer-heading"),
  ).find(
    (heading) => heading.textContent.trim().toLowerCase() === "quick links",
  );

  const quickLinksList = quickLinksHeading?.nextElementSibling;
  if (quickLinksList?.classList.contains("footer-links")) {
    quickLinksList.innerHTML = quickLinks
      .map((item) => {
        const href = isHomePage ? item.homeHref : item.otherHref;
        return `<li><a href="${href}">${item.label}</a></li>`;
      })
      .join("");
  }
};

const setupPrivilegeCardForm = () => {
  const form = document.getElementById("privilegeCardForm");
  if (!form) {
    return;
  }

  const fields = {
    name: document.getElementById("applicantName"),
    email: document.getElementById("applicantEmail"),
    phone: document.getElementById("applicantPhone"),
  };

  const submitBtn = document.getElementById("privilegeSubmitBtn");
  const liveStatus = document.getElementById("privilegeLiveStatus");
  const thanksBox = document.getElementById("privilegeThanks");

  if (
    !fields.name ||
    !fields.email ||
    !fields.phone ||
    !submitBtn ||
    !thanksBox
  ) {
    return;
  }

  const getFieldNote = (fieldId) =>
    form.querySelector(`[data-note-for="${fieldId}"]`);

  const getValidationState = (field) => {
    const value = field.value.trim();

    if (field.id === "applicantName") {
      const isValid = value.length >= 3;
      return {
        isValid,
        message: isValid
          ? "Looks good."
          : "Please enter at least 3 characters.",
      };
    }

    if (field.id === "applicantEmail") {
      const isValid = field.checkValidity() && value.length > 0;
      return {
        isValid,
        message: isValid ? "Email is valid." : "Enter a valid email address.",
      };
    }

    if (field.id === "applicantPhone") {
      const digits = value.replace(/\D/g, "");
      const isValid = digits.length >= 10 && digits.length <= 14;
      return {
        isValid,
        message: isValid
          ? "Phone number is valid."
          : "Phone must contain 10 to 14 digits.",
      };
    }

    return { isValid: false, message: "This field is required." };
  };

  const updateFieldState = (field) => {
    const value = field.value.trim();
    const note = getFieldNote(field.id);

    if (!value) {
      field.classList.remove("is-valid", "is-invalid");
      if (note) {
        note.textContent = "Required";
        note.classList.remove("is-valid");
      }
      return false;
    }

    const { isValid, message } = getValidationState(field);
    field.classList.toggle("is-valid", isValid);
    field.classList.toggle("is-invalid", !isValid);

    if (note) {
      note.textContent = message;
      note.classList.toggle("is-valid", isValid);
      note.classList.toggle("is-invalid", !isValid);
    }

    return isValid;
  };

  const updateFormState = () => {
    const fieldList = [fields.name, fields.email, fields.phone];
    const validCount = fieldList.filter((field) =>
      updateFieldState(field),
    ).length;
    const allValid = validCount === fieldList.length;

    submitBtn.disabled = !allValid;
    if (liveStatus) {
      liveStatus.textContent = allValid
        ? "Everything looks good. You can submit now."
        : `Complete ${validCount} of ${fieldList.length} fields correctly.`;
    }

    return allValid;
  };

  [fields.name, fields.email, fields.phone].forEach((field) => {
    field.addEventListener("input", updateFormState);
    field.addEventListener("blur", updateFormState);
  });

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    if (!updateFormState()) {
      const firstInvalid = [fields.name, fields.email, fields.phone].find(
        (field) => !field.classList.contains("is-valid"),
      );
      firstInvalid?.focus();
      return;
    }

    submitBtn.classList.add("is-loading");
    submitBtn.disabled = true;

    window.setTimeout(() => {
      const applicantName = fields.name.value.trim();
      form.classList.add("d-none");
      if (liveStatus) {
        liveStatus.classList.add("d-none");
      }
      thanksBox.innerHTML = `<i class="bi bi-patch-check-fill me-2"></i>Thank you, ${applicantName}! Your privilege card application has been received.`;
      thanksBox.classList.remove("d-none");
      submitBtn.classList.remove("is-loading");
    }, 650);
  });

  updateFormState();
};

syncSharedNavigationAndFooter();

const sections = document.querySelectorAll("section[id]");
const navLinks = document.querySelectorAll(
  ".side-nav .nav-link, .offcanvas .nav-link, .desktop-nav .nav-link",
);
const desktopNavbar = document.querySelector("#desktopNavbar");
const mobileMenuToggle = document.querySelector("#mobileMenuToggle");
const mobileMenu = document.querySelector("#mobileMenu");
const mobileMenuLinks = document.querySelectorAll("#mobileMenu .nav-link");
let mobileOffcanvas = null;

if (mobileMenuToggle && mobileMenu && window.bootstrap?.Offcanvas) {
  mobileOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(mobileMenu);
  mobileMenuToggle.addEventListener("click", () => {
    mobileOffcanvas.toggle();
  });
}

const getNavbarOffset = () => {
  const mobileTopbar = document.querySelector(".mobile-topbar");
  const activeNavbar =
    window.innerWidth < 992
      ? mobileTopbar
      : document.querySelector("#desktopNavbar");
  const navHeight = activeNavbar ? activeNavbar.offsetHeight : 0;
  return navHeight + 12;
};

mobileMenuLinks.forEach((link) => {
  link.addEventListener("click", (event) => {
    const href = link.getAttribute("href");
    if (!href || href === "#") {
      return;
    }

    const linkUrl = new URL(href, window.location.href);
    const isSamePage =
      linkUrl.origin === window.location.origin &&
      linkUrl.pathname === window.location.pathname;

    if (isSamePage && linkUrl.hash) {
      const target = document.querySelector(linkUrl.hash);
      if (!target) {
        return;
      }

      event.preventDefault();
      const top =
        target.getBoundingClientRect().top + window.scrollY - getNavbarOffset();
      window.scrollTo({ top: Math.max(top, 0), behavior: "smooth" });
      if (mobileOffcanvas) {
        mobileOffcanvas.hide();
      }
      window.history.replaceState(null, "", linkUrl.hash);
      return;
    }

    event.preventDefault();
    if (mobileOffcanvas) {
      mobileOffcanvas.hide();
      window.setTimeout(() => {
        window.location.assign(linkUrl.href);
      }, 220);
      return;
    }

    window.location.assign(linkUrl.href);
  });
});

const syncNavbarState = () => {
  if (desktopNavbar) {
    desktopNavbar.classList.toggle("is-scrolled", window.scrollY > 24);
  }
};

const currentPageFile = getCurrentPageFile();

// Preserve initial page-level active classes produced by syncSharedNavigationAndFooter()
navLinks.forEach((link) => {
  if (link.getAttribute("aria-current") === "page") {
    link.classList.add("active");
  }
});

window.addEventListener("scroll", () => {
  syncNavbarState();

  // Only run anchor/scroll-based active link detection on the home page
  if (currentPageFile !== "index.html") return;

  const current = Array.from(sections).find((section) => {
    const top = section.offsetTop - 120;
    const bottom = top + section.offsetHeight;
    return window.scrollY >= top && window.scrollY < bottom;
  });
  // If no section is in view, keep existing page-level active states
  if (!current) return;

  // Only consider nav links that are same-page anchors (e.g. index.html#home)
  const anchorLinks = Array.from(navLinks).filter((link) => {
    const href = link.getAttribute("href") || "";
    const linkUrl = new URL(href, window.location.href);
    return (
      linkUrl.origin === window.location.origin &&
      linkUrl.pathname === window.location.pathname &&
      linkUrl.hash
    );
  });

  // If the current section does not correspond to any anchor link, do nothing
  const matchingAnchorExists = anchorLinks.some((link) => {
    const linkUrl = new URL(link.getAttribute("href"), window.location.href);
    return linkUrl.hash === `#${current.id}`;
  });

  if (!matchingAnchorExists) return;

  anchorLinks.forEach((link) => {
    const linkUrl = new URL(link.getAttribute("href"), window.location.href);
    if (linkUrl.hash === `#${current.id}`) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });
});

syncNavbarState();
setupPrivilegeCardForm();

/* ==========================================================================
   06. DISHES HIGHLIGHTS SLIDER INITIALIZATION
   ========================================================================== */
$(function () {
  const $mcSliderWrap = $(".mc-slider-wrap");
  if (!$mcSliderWrap.length) return;

  const $mcSlider = $mcSliderWrap.find("#mcSlider");

  $mcSlider.slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    infinite: true,
    autoplay: false,
    autoplaySpeed: 2800,
    pauseOnHover: true,
    speed: 450,
    swipe: true,
    touchThreshold: 12,
    prevArrow: $mcSliderWrap.find(".mc-nav-prev"),
    nextArrow: $mcSliderWrap.find(".mc-nav-next"),
    appendDots: $mcSliderWrap.find(".mc-slider-dots"),
    customPaging: function (slider, i) {
      return (
        '<button class="menu-dot" aria-label="Go to slide ' +
        (i + 1) +
        '"></button>'
      );
    },
    responsive: [
      {
        breakpoint: 1200,
        settings: { slidesToShow: 3 },
      },
      {
        breakpoint: 992,
        settings: { slidesToShow: 2 },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          arrows: false,
          dots: true,
        },
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          arrows: false,
          dots: true,
          centerMode: true,
          centerPadding: "20px",
        },
      },
    ],
  });
});

/* ── Featured Dishes Quick View Modal ─────────────────────── */
(function () {
  const modalEl = document.getElementById("mcQuickViewModal");

  if (!modalEl || !window.bootstrap?.Modal) {
    return;
  }

  const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
  const modalImage = document.getElementById("mcQuickViewImage");
  const modalBadge = document.getElementById("mcQuickViewBadge");
  const modalTitle = document.getElementById("mcQuickViewTitle");
  const modalDesc = document.getElementById("mcQuickViewDesc");
  const modalServe = document.getElementById("mcQuickViewServe");
  const modalPrice = document.getElementById("mcQuickViewPrice");

  const openQuickView = (card) => {
    const img = card.querySelector(".mc-img");
    const badge = card.querySelector(".mc-badge");
    const title = card.querySelector(".mc-title");
    const desc = card.querySelector(".mc-desc");
    const serve = card.querySelector(".mc-serve-info");
    const price = card.querySelector(".mc-price");

    if (!img || !badge || !title || !desc || !serve || !price) {
      return;
    }

    modalImage.src = img.getAttribute("src") || "";
    modalImage.alt =
      img.getAttribute("alt") || title.textContent?.trim() || "Dish preview";
    modalBadge.textContent = badge.textContent?.trim() || "Dish";
    modalBadge.classList.toggle(
      "mc-badge--gold",
      badge.classList.contains("mc-badge--gold"),
    );
    modalTitle.textContent = title.textContent?.trim() || "";
    modalDesc.textContent = desc.textContent?.trim() || "";
    modalServe.innerHTML = serve.innerHTML;
    modalPrice.textContent = price.textContent?.trim() || "";

    modal.show();
  };

  document.addEventListener("click", (event) => {
    const card = event.target.closest(".mc-card-trigger");
    if (!card) {
      return;
    }

    // Ignore drag-end clicks from Slick while the slider is being swiped.
    if (card.closest(".slick-slider")?.querySelector(".slick-list.dragging")) {
      return;
    }

    openQuickView(card);
  });

  document.addEventListener("keydown", (event) => {
    const card = event.target.closest(".mc-card-trigger");
    if (!card) {
      return;
    }

    if (event.key === "Enter" || event.key === " ") {
      event.preventDefault();
      openQuickView(card);
    }
  });
})();

/* ==========================================================================
   05. HOUSE SIGNATURES & MAIN MENU SLIDER (FIXED INITIALIZATION)
   ========================================================================== */
$(function () {
  // Target the main slider shell instead of a nested track selector
  const $menuSlider = $("#menuSlider");
  if (!$menuSlider.length) return;

  // Find the slider viewport container holding the slide items directly
  const $sliderViewport = $menuSlider.find(".menu-slider-track");

  $sliderViewport.slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: false, // FIXED: Enabled dots so our custom CSS metric bars render properly
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2600,
    pauseOnHover: true,
    pauseOnFocus: true,
    speed: 420,
    swipe: true,
    touchThreshold: 10,
    prevArrow: $menuSlider.find(".menu-slider-prev"), // Clean contextual selectors
    nextArrow: $menuSlider.find(".menu-slider-next"),
    appendDots: $menuSlider.find(".menu-slider-dots"),
    customPaging: function (slider, i) {
      // Formats slick dots into clean custom markup matching our CSS .menu-dot class
      return (
        '<button class="menu-dot" aria-label="Go to slide ' +
        (i + 1) +
        '"></button>'
      );
    },
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: false,
          dots: true, // Keeps the sleek custom dash bars active on mobile touch screens
        },
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: false,
          centerMode: true,
          centerPadding: "20px", // Adjusted slightly for perfect geometric card balance
        },
      },
    ],
  });
});

/* ==========================================================================
   07. WATCH US ON REELS HUB SLIDER INITIALIZATION (EXACT ICON MARKUP FIX)
   ========================================================================== */
$(function () {
  const $reelsSlider = $("#reelsSlider");
  if (!$reelsSlider.length) return;

  $reelsSlider.slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    pauseOnHover: true,
    speed: 500,
    swipe: true,
    touchThreshold: 15,

    /* FIX: Changed from bi-arrow-left to bi-chevron-left inside the inner span 
       to match your existing menu slider structure perfectly.
    */
    prevArrow:
      '<button type="button" class="slick-prev"><span class="menu-control-icon" aria-hidden="true"><i class="bi bi-chevron-left"></i></span></button>',
    nextArrow:
      '<button type="button" class="slick-next"><span class="menu-control-icon" aria-hidden="true"><i class="bi bi-chevron-right"></i></span></button>',

    appendDots: $(".reels-section").find(".menu-slider-dots"),
    customPaging: function (slider, i) {
      return (
        '<button class="menu-dot" aria-label="Go to slide ' +
        (i + 1) +
        '"></button>'
      );
    },
    responsive: [
      {
        breakpoint: 1200,
        settings: { slidesToShow: 3 },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          arrows: false,
          dots: true,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          arrows: false,
          dots: true,
          centerMode: true,
          centerPadding: "40px",
        },
      },
    ],
  });
});

/* ── Floating Action Button: WhatsApp ────────────────────── */
(function () {
  const whatsappBtn = document.getElementById("whatsappBtn");
  if (!whatsappBtn) return;

  // Click feedback animation.
  whatsappBtn.addEventListener("click", () => {
    whatsappBtn.animate(
      [
        { transform: "translateY(0) scale(1)" },
        { transform: "translateY(-2px) scale(0.95)" },
        { transform: "translateY(0) scale(1.05)" },
        { transform: "translateY(0) scale(1)" },
      ],
      { duration: 320, easing: "cubic-bezier(0.34, 1.56, 0.64, 1)" },
    );
  });

  // Periodic nudge to draw attention without being distracting.
  setInterval(() => {
    whatsappBtn.classList.add("is-nudging");
    setTimeout(() => whatsappBtn.classList.remove("is-nudging"), 700);
  }, 7000);
})();

// review
$(".reviews-slider").slick({
  centerMode: true,
  centerPadding: "0px",
  slidesToShow: 3,
  infinite: true,
  speed: 900, // Slightly slower for a more "expensive" feel
  // This curve provides a very smooth, soft deceleration
  cssEase: "cubic-bezier(0.23, 1, 0.32, 1)",
  autoplay: true,
  autoplaySpeed: 4000,
  dots: true,
  arrows: false,
  useTransform: true, // Forces GPU acceleration
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        centerMode: true,
        centerPadding: "20px",
      },
    },
  ],
});

//menu card slider
$(document).ready(function () {
  // 1. Initialize Main Carousel Engine
  const $mainCarousel = $(".js-main-carousel").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2800,
    infinite: true,
    arrows: true,
    prevArrow: $(".prev-main"),
    nextArrow: $(".next-main"),
    responsive: [
      { breakpoint: 991, settings: { slidesToShow: 3 } },
      { breakpoint: 768, settings: { slidesToShow: 2 } },
      { breakpoint: 480, settings: { slidesToShow: 1 } },
    ],
  });

  // 2. Active Adaptive Layout Flag Variable
  let isMobile = window.innerWidth <= 991;

  // 3. Initialize Interactive Popup Image Thumbnail Swiper Engine
  const $modalCarousel = $(".js-modal-nav-carousel").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    vertical: !isMobile,
    verticalSwiping: !isMobile,
    arrows: !isMobile,
    prevArrow: $(".vert-prev"),
    nextArrow: $(".vert-next"),
    infinite: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          vertical: false,
          verticalSwiping: false,
          arrows: false,
          slidesToShow: 3,
          variableWidth: true,
        },
      },
      {
        breakpoint: 480,
        settings: {
          vertical: false,
          verticalSwiping: false,
          arrows: false,
          slidesToShow: 2,
          variableWidth: true,
        },
      },
    ],
  });

  // 4. Handle viewport updates
  $(window).on("resize", function () {
    const checkMobile = window.innerWidth <= 991;
    if (checkMobile !== isMobile) {
      isMobile = checkMobile;
      location.reload();
    }
  });

  // 5. Instantly swap active big menu card photo frame elements
  $modalCarousel.on("afterChange", function (event, slick, currentSlide) {
    const activeImgSrc = $(slick.$slides[currentSlide]).attr("data-img");
    $("#modal-active-display-img").attr("src", activeImgSrc);
  });

  // 6. Interaction Event: Popup Window Open Action
  $(".menu-thumb-card").on("click", function () {
    // ADD THESE TWO LINES:
    $(".menu-thumb-card").removeClass("active-card");
    $(this).addClass("active-card");

    const targetIndex = $(this).data("index");
    const targetImg = $(this).data("img");

    $mainCarousel.slick("slickPause");

    $("#modal-active-display-img").attr("src", targetImg);
    $(".js-modal-overlay").addClass("active");

    setTimeout(() => {
      $modalCarousel.slick("setPosition");
      $modalCarousel.slick("slickGoTo", targetIndex, true);
    }, 60);
  });

  // 7. Interaction Event: Popup Window Close Action
  $(".js-close-modal, .js-modal-overlay").on("click", function (e) {
    if (
      e.target === this ||
      $(this).hasClass("js-close-modal") ||
      $(this).parents(".js-close-modal").length
    ) {
      $(".js-modal-overlay").removeClass("active");
      $mainCarousel.slick("slickPlay");
    }
  });
});










$(document).ready(function(){
  
  // 1. Text Content Slider 
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    cssEase: 'cubic-bezier(0.25, 1, 0.5, 1)',
    speed: 800, /* Synchronized with CSS transition */
    asNavFor: '.slider-nav',
    prevArrow: $('.custom-prev'),
    nextArrow: $('.custom-next')
  });
  
  // 2. Image Thumbnail Slider
  $('.slider-nav').slick({
    slidesToShow: 3,         
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    arrows: false,
    centerMode: true,        
    focusOnSelect: true,
    vertical: true,          
    verticalSwiping: true,
    centerPadding: '0px',
    cssEase: 'cubic-bezier(0.25, 1, 0.5, 1)',
    speed: 800, /* Synchronized with CSS transition */
    responsive: [
      {
        breakpoint: 991, 
        settings: {
          vertical: false,         
          verticalSwiping: false,
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 3          
        }
      },
      {
        breakpoint: 575,
        settings: {
          vertical: false,
          verticalSwiping: false,
          centerMode: true,
          centerPadding: '0px',
          slidesToShow: 3          
        }
      }
    ]
  });

  // 3. Popup Modal Logic
  $(document).on('click', '.trigger-menu-popup', function(e) {
    e.preventDefault();
    $('#menuPopup').css('display', 'flex').hide().fadeIn(300);
  });

  $('#menuPopup, .menu-modal-close').on('click', function(e) {
    if (e.target === this || $(this).hasClass('menu-modal-close') || $(this).closest('.menu-modal-close').length) {
      $('#menuPopup').fadeOut(300);
    }
  });

});