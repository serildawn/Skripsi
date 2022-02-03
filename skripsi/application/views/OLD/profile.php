<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php echo form_open_multipart('') ?>
    <img src="<?php echo base_url('storage/users/'.$userlogin['gambar']) ?>" width="100px" alt="">
    
    <input type="file" name="gambar">
    <?php echo form_error('gambar', '', '') ?>
    <br>
    <br>


    <input type="text" name="nama" placeholder="nama" value="<?php echo $userlogin['nama'] ?>">
    <?php echo form_error('nama', '', '') ?>
    <br>
    <br>

    <input type="text" name="username" placeholder="username" value="<?php echo $userlogin['username'] ?>">
    <?php echo form_error('username', '', '') ?>
    <br>
    <br>
    <input type="text" name="password" placeholder="password">
    <?php echo form_error('password', '', '') ?>
    <br>
    <br>
    <input type="text" name="repassword" placeholder="repassword">
    <?php echo form_error('repassword', '', '') ?>


    <br>
    <br>
    <input type="submit">
    <?php echo form_close() ?>
</body>

</html>