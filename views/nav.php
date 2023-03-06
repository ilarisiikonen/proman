<nav class="navbar"> 
    <a id="title" href="/~e2101365/php/proman/views">theTrackerAppp</a>
    <a class="toggle" id="toggle">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>
    <div class="navbar-links" id="navbar-links">
       <ul>
        <li><a href="/~e2101365/php/proman/controllers/project_list.php">Project List</a></li>
        <li><a href="/~e2101365/php/proman/controllers/task_list.php">Task list</a></li>
        <li><a href="/~e2101365/php/proman/controllers/project.php">Add Project</a></li>
        <li><a href="/~e2101365/php/proman/controllers/task.php">Add Task</a></li>
     </ul> 
    </div>
    
</nav>


<script>
/* MVC malli takia sijainti täällä. */
const toggle = document.getElementById('toggle');
const navbarLinks = document.getElementById('navbar-links');

toggle.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
    console.log("scripti navis")
})


</script>