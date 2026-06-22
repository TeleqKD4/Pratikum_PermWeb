<!DOCTYPE html>
<html>
<head>

<title>Admin Portal Berita</title>

<style>

body{
font-family:Arial;
margin:0;
}

.header{
background:#3f51b5;
color:white;
padding:20px;
}

.menu{
background:#1a237e;
padding:10px;
}

.menu a{
color:white;
margin-right:20px;
text-decoration:none;
}

.container{
padding:20px;
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
border:1px solid #ddd;
padding:10px;
}

th{
background:#3f51b5;
color:white;
}

.btn{
padding:5px 10px;
background:#2196f3;
color:white;
text-decoration:none;
}

.btn-danger{
background:red;
}

</style>

</head>

<body>

<div class="header">
<h1>Admin Portal Berita</h1>
</div>

<div class="menu">
<nav>
    <a href="<?= base_url('/admin/artikel'); ?>">Kelola Artikel</a> | 
    
    <a href="<?= base_url('/'); ?>">Dashboard</a>|
    
    <a href="<?= base_url('/admin/artikel/add'); ?>">Tambah Artikel</a>
</nav>
</div>

<div class="container">