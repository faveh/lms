<?php 
if( !(isset($ld)) ) {
    $ld = "./";
}
if ($ld == "../../") {
    $lld = "../";
} else {
    $lld = "./";
}


if( isset($nav_page) && isset($nav_webname) && isset($nav_glyphicon) ) {
    // Do nothing
} else {
    $nav_page = array(0=>"dashboard",1=>"profile",2=>"books",3=>"users",4=>"catalogue",5=>"borrowed",
        6=>"downloaded",7=>"settings",8=>"backup");
    $nav_webname = array(0=>"Dashboard",1=>"Profile",2=>"Manage Books",3=>"Manage Users",4=>"Manage Catalogue",5=>"Borrowed List",
        6=>"Downloaded List",7=>"LMS Settings",8=>"Backup & Restore");
    $nav_glyphicon = array(0=>"dashboard",1=>"edit",2=>"book",3=>"user",4=>"th",5=>"list",
        6=>"list-alt",7=>"cog",8=>"repeat");
}

?>


<div class="col-md-2 side-bar">
    <div class="well">
        <h4 class="text-center">Admin <strong class="bg-default"><?php echo strtoupper($admin['username']); ?></strong></h4>
        <a class="thumbnail prof-pic">
            <img src="<?php echo $ld.ASSETS_IMGS; ?>prof-pic.jpg" width="100" height="100">
        </a>
        <span id="logout" class="center-block text-center"><a href="<?php echo $lld; ?>logout/" class="btn btn-xs btn-danger">logout</a></span>
        <ul class="list-group admin-options">
            <?php
            for ($i=0; $i <= 8; $i++) {
                if($pagename == "dashboard") {
                    if($nav_page[$i] == $pagename) {
                        echo "<li><a class='active' href='./'><span class='glyphicon glyphicon-$nav_glyphicon[$i]'></span> $nav_webname[$i]</a></li>";
                    } else {
                        echo "<li><a href='$nav_page[$i]/'><span class='glyphicon glyphicon-$nav_glyphicon[$i]'></span> $nav_webname[$i]</a></li>";
                    }
                } else {
                    if($nav_page[$i] == $pagename) {
                        echo "<li><a class='active' href='./'><span class='glyphicon glyphicon-$nav_glyphicon[$i]'></span> $nav_webname[$i]</a></li>";
                    } else {
                        echo "<li><a href='../$nav_page[$i]/'><span class='glyphicon glyphicon-$nav_glyphicon[$i]'></span> $nav_webname[$i]</a></li>";
                    }
                }
            }
            ?>
            <!--<li class="btn-group center-block open"><a href="./" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-book'></span> Books <span class='caret'></span></a>
            <ul class="dropdown-menu" style="background-color: rgba(0,0,0,0);">
            <li style="margin: -5px 0;"><a href="#"><span class='glyphicon glyphicon-plus'></span> Add Books</a></li>
            <li style="margin: -5px 0;"><a href="#"><span class='glyphicon glyphicon-pencil'></span> Edit Books</a></li>
            </ul>
            </li>-->
        </ul>
        <strong>Total Online Users <span class="badge pull-right">0</span></strong>
    </div>
</div>

<?php
$pageTabPinQuery = "SELECT tab_pinned FROM $lms_page_setup WHERE page_name='$pagename'";
$isPinned = array("", "hidden", "hidden");

    if(isset($conn)) {
        $pageTabPinResult = mysqli_query($conn, $pageTabPinQuery);

        while($pageTabPin = mysqli_fetch_assoc($pageTabPinResult)) {
            $pinnedTab = $pageTabPin['tab_pinned'];
        }
        for($i=0; $i<3; $i++) {
            if($isPinned[$i] == $pinnedTab) {
                $isPinned[$i] = "";
            } else { $isPinned[$i] = "hidden"; }
        }
    }

?>