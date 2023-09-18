<?php
include './header.php';
include './admin/inc/database.php';
    // session_start();
    require_once("./config.php");
    $db = new Database();
$lastLinks = $db->query('SELECT * FROM link ORDER BY id DESC LIMIT 5')->fetchAll();
// $url_path = $_SERVER['REQUEST_URI'];

if(isset($_GET['c'])){ 
    $main_url = $db->select('link','url',['code'=>$_GET['c']]);
    $is_Spam = $db->select('spam_links','url',['url'=>$main_url[0]]);
?>
<?php if(isset($is_Spam[0])){?>
<div class="modal show" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background: red; color:#ffffff;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>ALERT!</strong> Be Careful.</h4>
            </div>
            <div class="modal-body">
                <p>The URL that you are going is reported as a Spam.</p>
            </div>
            <div class="modal-footer">
                <a href="<?php echo $main_url[0];?>" class="btn btn-danger">Redirect Me!</a>
            </div>
        </div>

    </div>
</div>
<?php }else{
    header("Location: {$main_url[0]}");
}
?>
<?php }
    
?>
<br>
<center>
    <h1><?php echo SITE_NAME; ?></h1>
    <?php
    if (isset($_SESSION['success'])) {
        echo "<p class='success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p class='alert'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    if (isset($_GET['error']) && $_GET['error'] == 'db') {
        echo "<p class='alert'>Error in connecting to database!</p>";
    }
    if (isset($_GET['error']) && $_GET['error'] == 'inurl') {
        echo "<p class='alert'>Not a valid URL!</p>";
    }
    if (isset($_GET['error']) && $_GET['error'] == 'dnp') {
        echo "<p class='alert'>Ok! So I got to know you love playing! But don't play here!!!</p>";
    }
    ?>
    <form method="POST" action="functions/shorten.php">
        <div class="section group">
            <div class="col span_3_of_3">
                <input type="url" id="input" name="url" class="form-control" placeholder="Enter a URL here">
            </div>
            <div class="col span_1_of_3">
                <input type="text" id="custom" name="custom" class="form-control" placeholder="Enable custom text"
                    disabled>
            </div>
            <div class="col span_2_of_3">
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch"
                        onclick="toggle()">
                    <label class="onoffswitch-label" for="myonoffswitch"></label>
                </div>
            </div>
        </div>
        <input type="submit" value="Go" class="btn-success submit">
    </form>
</center>
<center style="background : #f7f7f7; margin-top: 50px;">
    <div class="container">
        <h3>Last 5 Short Urls </h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Full URL</th>
                    <th>Short URL</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lastLinks as $key => $link) { ?>
                <tr>
                    <td><?php echo substr($link['url'],0,50).'...'; ?></td>
                    <td><a href="<?php echo 'http://localhost:80/short_march?c='.$link['code']; ?>">
                            <?php echo 'http://localhost:80/short_march?c='.$link['code']; ?> </a></td>
                    <td><?php echo $link['created']; ?></td>
                </tr>
                <?php   }?>
            </tbody>
        </table>
    </div>
</center>
<script>
function toggle() {
    if (document.getElementById('myonoffswitch').checked) {
        document.getElementById('custom').placeholder = 'Enter your custom text'
        document.getElementById('custom').disabled = false
        document.getElementById('custom').focus()
    } else {
        document.getElementById('custom').value = ''
        document.getElementById('custom').placeholder = 'Enable custom text'
        document.getElementById('custom').disabled = true
        document.getElementById('custom').blur()
        document.getElementById('input').focus()
    }
}
</script>