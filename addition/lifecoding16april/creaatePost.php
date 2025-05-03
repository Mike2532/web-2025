<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cоздать Пост</title>
    </head>
    <body>
        <form action="api.php?act=uploader" enctype="multipart/form-data" method="POST">
            <div>
                <label>картинка</label>
                <input type="file" name="image" accept=".png" required>
            </div>
        </form>
    </body>
</html>