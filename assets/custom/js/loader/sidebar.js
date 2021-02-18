const setContentLoader = (target = ".content") => {
  $(target).html(
    '<div class="page-content-wrap">' +
      '<div class="row">' +
      '<div class="col-md-12">' +
      '<div class="loader">Loading...</div>' +
      "</div>" +
      "</div>" +
      "</div>"
  );
};

const setCurrentNav = (defaultLink) => {
  setContentLoader();
  const menu = localStorage.getItem("menu");
  const submenu = localStorage.getItem("submenu");
  const currentUrl = localStorage.getItem("currentUrl");
  const secondaryUrl = localStorage.getItem("secondaryUrl");
  const secondaryTarget = localStorage.getItem("secondaryTarget");

  if (menu) $(menu).addClass("active");
  if (submenu) $(submenu).addClass("active");
  if (currentUrl) {
    setTimeout(() => {
      loadContent(currentUrl, ".content");
      if (secondaryUrl) {
        setTimeout(() => {
          loadContent(secondaryUrl, secondaryTarget);
        }, 100);
      }
    }, 200);
  } else {
    setTimeout(() => {
      loadContent(defaultLink, ".content");
    }, 200);
  }
};

const setActiveMenu = (menu) => {
  const activeMenu = localStorage.getItem("menu");
  if (activeMenu) $(activeMenu).removeClass("active");

  localStorage.setItem("menu", menu);
  $(menu).addClass("active");
};

const setActiveSub = (submenu) => {
  const activeSub = localStorage.getItem("submenu");
  if (activeSub) $(activeSub).removeClass("active");

  if (submenu) {
    localStorage.setItem("submenu", submenu);
    $(submenu).addClass("active");
  }
};

$(".x-navigation-minimize").on("click", function (e) {
  setSidebar();
  setTimeout(() => {
    window.location.reload();
  }, 1000);
});

const setSidebarOnLoad = () => {
  const sidebar = localStorage.getItem("sidebar");
  if (sidebar === "minimize") {
    setMaximize();
  } else if (sidebar === "maximize") {
    setMinimze();
  } else {
    localStorage.setItem("sidebar", "minimize");
  }
};

const setSidebar = () => {
  const sidebar = localStorage.getItem("sidebar");
  if (sidebar === "minimize") {
    localStorage.setItem("sidebar", "maximize");
    setMaximize();
  } else if (sidebar === "maximize") {
    localStorage.setItem("sidebar", "minimize");
    setMinimze();
  } else {
    localStorage.setItem("sidebar", "minimize");
    setMinimze();
  }
};

const setMinimze = () => {
  $(".page-container").addClass("page-navigation-toggled");
  $(".page-container").addClass("page-container-wide");
  $(".nav-customx").addClass("x-navigation-minimized");
};

const setMaximize = () => {
  $(".page-container").removeClass("page-navigation-toggled");
  $(".page-container").removeClass("page-container-wide");
  $(".nav-customx").removeClass("x-navigation-minimized");
};
