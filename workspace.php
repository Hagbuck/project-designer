<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" lang="fr" content="Vuillemin Anthony" />
    <link rel="stylesheet" type="text/css" href="stylesheet/default.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/workspace.css">
    <script src="js/jquery.js"></script>

    <title>Workspace</title>
</head>
<body>
    <?php include("header.php"); ?>
    <h1 id="diagHeader"><a href="myproject.php"><span id="projetNameHeader"></span></a> > <span id="diagNameHeader"></span></h1>

    <div id="flexbox">

        <div id="leftBlock">
        <div id="toolBox">
            <h3>Tool Box</h3> <br>
            <div id="editBox" class="flex_element">

              <h4>Note #<span id="tag_id"></span>  </h4> <br>
              <input id="tag_text" type="text" placeholder="Text note" /> <br>
              <input type="color" name="tag_color" id="tag_color" onchange="replace_hexa(this.value);" > <input id="tag_hexa" type="text" placeholder="#FFFFFF" onchange="replace_color(this.value);"/>  <br />
              <div id="update_tag" onclick="updateTag(1)" class="toolButton"> <span>Update</span></div>
              <div id="delete_tag" onclick="removeTag()" class="toolButton"> <span>Delete me !</span></div>

            </div>

              <!-- A MODIF PAR ID DIAG -->
              <div id="new_tag" onclick="newTag(1)" class="toolButton">
                    <span>New Tag</span>
                </div>
              <div id="new_branch" onclick="newBranch(1)" class="toolButton">
                  <span>New Branch</span>
              </div>
              <div id="del_branch" onclick="delBranch(1)" class="toolButton">
                  <span>Delete a Branch</span>
              </div>
          </div>
          <!-- <div id="chatbox" class="flex_element"></div> -->
        </div>

        <div id="rightBlock">
          <div id="container" class="flex_element"></div>
        </div>
      </div>

    <?php include("footer.php"); ?>
</body>
<script src="js/konvas.min.js"></script>
<script src="js/workspace-utils.js"></script>
<script src="js/workspace.js"></script>
</html>
  <?php

  if(!isset($_GET['project']) || !isset($_GET['diag']))
    echo "<script>invalid_access();</script>";
  else
    echo "<script>valid_access('".$_GET['project']."','".$_GET['diag']."')</script>";



  ?>
  <script>
    if($("#tag_id").html()=="")
      $("#tag_id").html("none");


    function replace_hexa(value)
    {
      $("#tag_hexa").val(value);
    }

    function replace_color(value)
    {
      $("#tag_color").val(value);
    }

  </script>
