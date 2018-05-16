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
    <h1>TITRE DU DIAGRAMME</h1>
    <div id="flexbox">
        <div id="tag_edit" class="flex_element">
            <form method="post" action="/change_tag_values.php">
                <label for="tag_id">Tag id : </label>
                <input type="number" name="tag_id" id="tag_id" disabled><br \>

                <label for="tag_text"> Tag text : </label>
                <input type="text" name="tag_text" id="tag_text"> <br />

                <label for="tag_color">Tag color : </label>
                <input type="color" name="tag_color" id="tag_color"> <br />
                
                <input type="submit">
            </form>
            <div id="delete_tag" onclick="removeTag()">
                <p>Remove tag</p>
            </div>
        </div>
        <div id="container" class="flex_element"></div>
        <div id="chatbox" class="flex_element"></div>
    </div>
    <?php include("footer.php"); ?>
    <script src="js/jquery.js"></script>
    <script src="js/konvas.min.js"></script>
    <script src="js/workspace-utils.js"></script>
    <script src="js/workspace.js"></script>
</body>
</html>
