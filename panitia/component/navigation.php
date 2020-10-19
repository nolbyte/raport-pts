<?php
defined("RESMI") or die("Akses ditolak");
?>
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">NAVIGASI</li>
    <li>
        <a href="index.php">
            <i class="fa fa-th"></i> <span>Dashboard</span>            
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-gears"></i><span>Sistem</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li><a href="index.php?mod=system&hal=sekolahID"><i class="fa fa-circle-o"></i> Identitas Sekolah</a></li>            
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i><span>Raport</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li><a href="index.php?mod=raport&hal=ips"><i class="fa fa-circle-o"></i> Data Nilai IPS</a></li>
            <li><a href="index.php?mod=raport&hal=ipa"><i class="fa fa-circle-o"></i> Data Nilai IPA</a></li>            
        </ul>
    </li>
    <li>
        <a href="index.php?mod=system&hal=pengguna">
            <i class="fa fa-user"></i> <span>Profile Pengguna</span>            
        </a>
    </li>
</ul>