<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="CRUD/insert">Insert</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Level</th>
            <th>Gambar</th>
            <th></th>
        </tr>
        <?php foreach($users_data as $key => $value): ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value->nama ?></td>
                <td><?php echo $value->username ?></td>
                <td><?php echo $value->level ?></td>
                <td><img src="<?php echo base_url('storage/users/'.$value->gambar) ?>" width="100px" alt=""></td>
                <td>
                    <a href="CRUD/update/<?php echo $value->id ?>">update</a>
                    <a href="CRUD/delete/<?php echo $value->id ?>">delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>
</html>