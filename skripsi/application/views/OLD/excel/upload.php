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
    <input type="file" name="excel">
    <input type="submit">
    <?php echo form_close(); ?>
</body>
</html>