
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="../home">Home</a>
<?php if ($_SESSION['role'] == 1) { ?>
    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Admin</a>
    <ul class="collapse list-unstyled" id="pageSubmenu">
        <li>
            <a href="../role">User Type</a>
        </li>
        <li>
            <a href="../status">Status</a>
        </li>
        <li>
            <a href="../courier">Courier</a>
        </li>
    </ul>
    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">User</a>
    <ul class="collapse list-unstyled" id="pageSubmenu1">
        <li>
            <a href="../inventorylist">Inventory</a>
        </li>
        <li>
            <a href="../userlist">User</a>
        </li>
        <li>
            <a href="../user_address">Address</a>
        </li>
        <li>
            <a href="../user_shipment">Shipment</a>
        </li>
    </ul>

<?php } else { ?>
    <a href="../inventory">Inventory</a>
    <a href="../address">Address</a>
    <a href="../shipment">Shipment</a>
<?php } ?>
</div>