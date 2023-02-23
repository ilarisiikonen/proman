const toggle = document.getElementById('toggle');
const navbarLinks = document.getElementById('navbar-links');

toggle.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})

console.log("toimii")