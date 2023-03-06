const toggle = document.getElementById('toggle');
const navbarLinks = document.getElementById('navbar-links');

toggle.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
    console.log("script js")
})



/* show comments */
const showComments = document.getElementById('showComments');
const comments = document.getElementsByClassName('comments')

showComments.addEventListener('click', () => {
    if (comments.style.display === 'none') {
        comments.style.display === 'block'
    } else {
        comments.style.display === 'none'
    }
    console.log("show comments toggle")
})