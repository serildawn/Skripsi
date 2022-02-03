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
    <img src="<?php echo base_url('storage/users/' . $users_data->gambar) ?>" width="100px" alt="">

    <input type="file" name="gambar">
    <?php echo form_error('gambar', '', '') ?>
    <br>
    <br>


    <input type="text" name="nama" placeholder="nama" value="<?php echo $users_data->nama ?>">
    <?php echo form_error('nama', '', '') ?>
    <br>
    <br>

    <input type="text" name="username" placeholder="username" value="<?php echo $users_data->username ?>">
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
    <select name="level" id="">
        <option value="1" <?php echo ($users_data->level == 1 ? 'selected' : '') ?>>Admin</option>
        <option value="2" <?php echo ($users_data->level == 2 ? 'selected' : '') ?>>Others</option>
    </select>

    <br>
    <br>
    <input type="submit">
    <?php echo form_close() ?>
</body>

</html>