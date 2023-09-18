<?php 
include './header.php'
?>
<div class="container">
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Login Successful
    </div>
    <div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">User Dashboard</a>
            </li>
            <hr />
            <li class="nav-item">
                <a class="nav-link" href="#">Short URL</a>
            </li>
            <hr />
            <li class="nav-item">
                <a class="nav-link" href="#">Report URL</a>
            </li>
            <hr />
            <li class="nav-item">
                <a class="nav-link" href="#">Detect URL</a>
            </li>
        </ul>

    </div>
</div>
<style>
/* The alert message box */
.alert {
    padding: 20px;
    background-color: #60BB6D;
    /* Red */
    color: white;
    margin-bottom: 15px;
}

/* The close button */
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
    color: black;
}
</style>