<div class="page-title-area">
            <div class="row">
                <div class="col-md-2">
                    <span style="font-size:25px;cursor:pointer" onclick="openNav()">&#9776;</span>
                </div>
                <div  class="col-md-9">
                </div>
                <div class="col-md-1">
                    <div class="user-profile pull-right">
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']?> <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <?php if ($_SESSION['role'] == 1) { ?>
                                <a class="dropdown-item" href="../home?logout='1'">Logout</a>
                            <?php } else { ?>
                                <a class="dropdown-item" href="update">Edit Profile</a>
                                <a class="dropdown-item" href="../home?logout='1'">Logout</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>