
<?php 
session_start();
$page = 'Add';
include '../function.php';

if ($_SESSION['roleId'] != 1 || !isset($_SESSION['login'])) {
    header('Location: ../');
}



if(isset($_POST['submit'])) {
    if(add($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambahkan!');
            document.location.href = '../';
            </script>";
    } else {
        echo "<script>
            alert('data gagal ditambahkan!')
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giftyy | <?= $page; ?></title>
    <style>
        body {
            background-color: #f89cab;
        }
        .container {
            height: 500px;
            padding: 20px;
            display: flex;
            justify-content: center;

        }

        h1 {
            margin: 10px;
            padding: 10px;
            display: block;
        }

        table {
            display: inline;
        }
    </style>
</head>
<body>

    <h1>Tambah </h1>
    <div class="container">
        <table>
        <form action="" method="post">
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="file" name="image" id="image"></td>
            </tr>
        <tr>
            <td><label for="name">Nama : </label></td>
            <td><input name="name" id="name" type="text"></td>
        </tr>
        <tr>
            <td><label for="type">Type : </label></td>
            <td>
                <select name="type" id="type">
                    <?php $query2 = query("SELECT * FROM type");
                          foreach($query2 as $data2) :?>
                    <option value="<?= $data2['typeId']; ?>">
                            <?= $data2['typeName']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>    
        <tr>
            <td><label for="price">Price : </label></td>
            <td><input name="price" id="price" type="text" ></td>
        </tr>    
        <tr>
            <td><label for="description">Description : </label></td>
            <td><textarea name="description" id="description"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="submit" id="submit">Tambah!</button></td>
        </tr>    
        </form>
        </table>
    </div>
</body>
</html>