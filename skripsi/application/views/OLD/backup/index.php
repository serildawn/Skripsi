<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>No</td>
            <td>Name</td>
            <td></td>
        </tr>
        <?php foreach($backup_tmp as $key => $value): ?>
            <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $value ?></td>
                <td>
                    <a href="Backup/restoredb/<?php echo $value ?>">Read</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>