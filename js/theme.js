if (localStorage.getItem('theme')) {
    document.documentElement.setAttribute('data-theme', localStorage.getItem('theme'));
    document.addEventListener("DOMContentLoaded", function(event) {
        if (document.getElementById('toggle-theme_icon')) {
            icon = (localStorage.getItem('theme') === "dark") ? "light_mode" : "dark_mode";
            document.getElementById('toggle-theme_icon').innerHTML = icon;
        }
    });
}
function changeTheme(newTheme) {
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme); 
}
function toggleTheme(){
    newTheme = (localStorage.getItem('theme') === "dark") ? "light" : "dark";
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme); 
    if (document.getElementById('toggle-theme_icon')) {
        icon = (localStorage.getItem('theme') === "dark") ? "light_mode" : "dark_mode";
        document.getElementById('toggle-theme_icon').innerHTML = icon;
    }
}