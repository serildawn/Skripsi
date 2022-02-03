<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="username" placeholder="username" value="<?php echo set_value('username') ?>">
        <?php echo form_error('username','','') ?>
        <br>
        <br>
        <input type="text" name="password" placeholder="password">
        <?php echo form_error('password','','') ?>

        <br>
        <br>
        <input type="submit">
    </form>
</body>
</html>