const loadContent = (url, div) => {
  $(div).load(url);
};

$(".side-menu").on("click", function (e) {
  const element = $(this);
  const url = element.data("url");
  const menu = element.data("menu");

  setContentLoader();
  setActiveMenu(menu);
  setActiveSub(null);
  localStorage.setItem("currentUrl", url);
  if (url) loadContent(url, ".content");
});

$(".side-submenu").on("click", function (e) {
  const element = $(this);
  const url = element.data("url");
  const menu = element.data("menu");
  const submenu = element.data("submenu");

  setContentLoader();
  setActiveMenu(menu);
  setActiveSub(submenu);
  localStorage.setItem("currentUrl", url);
  if (url) loadContent(url, ".content");
});

$(document.body).on("click", ".link-to", function (e) {
  e.preventDefault();
  const element = $(this);
  const to = element.data("to");
  const target = element.data("target");

  localStorage.setItem("currentUrl", to);

  target ? setContentLoader(target) : setContentLoader();
  target ? loadContent(to, target) : loadContent(to, ".content");
});

$(document.body).on("click", ".link-to-unsave", function (e) {
  e.preventDefault();
  const element = $(this);
  const to = element.data("to");
  const target = element.data("target");

  target ? setContentLoader(target) : setContentLoader();
  target ? loadContent(to, target) : loadContent(to, ".content");
});

$(document.body).on("click", ".link-to-with-prev", function (e) {
  e.preventDefault();
  const element = $(this);
  const to = element.data("to");
  const target = element.data("target");

  const menu = element.data("menu");
  const submenu = element.data("submenu");

  if (menu) setActiveMenu(menu);
  if (submenu) setActiveSub(submenu);

  const prevUrl = localStorage.getItem("currentUrl");

  localStorage.setItem("currentUrl", to);
  localStorage.setItem("prevUrl", prevUrl);

  target ? setContentLoader(target) : setContentLoader();
  target ? loadContent(to, target) : loadContent(to, ".content");
});

$(document.body).on("click", ".go-back", function (e) {
  e.preventDefault();
  const element = $(this);
  const target = element.data("target");

  const to = localStorage.getItem("prevUrl");
  localStorage.setItem("currentUrl", to);

  target ? setContentLoader(target) : setContentLoader();
  target ? loadContent(to, target) : loadContent(to, ".content");
});
