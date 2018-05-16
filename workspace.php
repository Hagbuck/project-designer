<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" lang="fr" content="Vuillemin Anthony" />
    <link rel="stylesheet" type="text/css" href="stylesheet/default.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/workspace.css">
    <title>Workspace</title>
</head>
<body>
    <?php include("header.php"); ?>
    <iframe src="work_window.php" width="60%" height="60%" frameborder="0" allowfullscreen></iframe>
    <div id="tag_edit">
        <form method="post" action="/change_tag_value.php">
            <label for="tag_text"> Tag text : </label>
            <input type="text" name="tag_text" id="tag_text"> <br />

            <label for="tag_color">Tag color : </label>
            <input type="color" name="tag_color" value="#ff0000"> <br />
            
            <input type="submit">
        </form>
    </div>
</body>
</html>
