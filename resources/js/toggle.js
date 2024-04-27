const themeMode = document.getElementById("theme-mode");

if (
    localStorage.getItem("dark-mode") === "true" ||
    (!("dark-mode" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    document.querySelector("html").classList.add("dark");
    document.getElementById("theme-mode").title = "Theme: Dark";
} else {
    document.querySelector("html").classList.remove("dark");
    document.getElementById("theme-mode").title = "Theme: Light";
}

const lightSwitches = document.querySelectorAll(".light-switch");
if (lightSwitches.length > 0) {
    lightSwitches.forEach((lightSwitch, i) => {
        if (localStorage.getItem("dark-mode") === "true") {
            lightSwitch.checked = true;
        }
        lightSwitch.addEventListener("change", () => {
            const { checked } = lightSwitch;
            lightSwitches.forEach((el, n) => {
                if (n !== i) {
                    el.checked = checked;
                }
            });
            if (lightSwitch.checked) {
                document.documentElement.classList.add("dark");
                localStorage.setItem("dark-mode", true);
                document.getElementById("theme-mode").title = "Theme: Dark";
            } else {
                document.documentElement.classList.remove("dark");
                localStorage.setItem("dark-mode", false);
                document.getElementById("theme-mode").title = "Theme: Light";
            }
        });
    });
}

if (localStorage.getItem("show-toggle") === "true") {
    themeMode.classList.remove("hidden");
}

if (localStorage.getItem("show-toggle") === "false") {
    themeMode.classList.add("hidden");
}

document.addEventListener("keydown", function (event) {
    if ((event.ctrlKey || event.metaKey) && event.key === ".") {
        const storage = localStorage.getItem("show-toggle");

        if (storage === "false" || storage === null) {
            localStorage.setItem("show-toggle", true);
        } else {
            localStorage.setItem("show-toggle", false);
        }

        event.preventDefault();
        document.getElementById("theme-mode").classList.toggle("hidden");
    }
});
