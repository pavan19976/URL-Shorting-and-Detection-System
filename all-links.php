<?php
include './header.php';
include './admin/inc/database.php';
    // session_start();
    require_once("./config.php");
    $db = new Database();
$lastLinks = $db->query('SELECT * FROM link ORDER BY id DESC LIMIT 20')->fetchAll();
?>
<center style="background : #f7f7f7; margin-top: 50px;">
    <div class="container">
        <h3>Last Of Short Urls </h3>
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
                    <td><a href="<?php echo 'http://makeitshort.ga?c='.$link['code']; ?>">
                            <?php echo 'http://makeitshort.ga?c='.$link['code']; ?> </a></td>
                    <td><?php echo $link['created']; ?></td>
                </tr>
                <?php   }?>
            </tbody>
        </table>
    </div>
</center>