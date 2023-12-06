window.onload = () => {
  if (
    localStorage.getItem("theme") == "dark" ||
    window.matchMedia("(prefers-color-scheme: dark)").matches
  ) {
    document.documentElement.setAttribute("data-theme", "dark");
    document.getElementById("theme_switcher").textContent = "clear_day";
  }

  document.getElementById("theme_switcher").onclick = (e) => {
    let change = [];
    document.documentElement.getAttribute("data-theme") == "dark"
      ? (change = ["light", "clear_night"])
      : (change = ["dark", "clear_day"]);
    document.documentElement.setAttribute("data-theme", change[0]);
    localStorage.setItem("theme", change[0]);
    e.target.textContent = change[1];
    e.preventDefault();
  };
};
