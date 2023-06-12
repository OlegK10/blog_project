<?php
include '../global/db.php';
if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $imgData = file_get_contents($_FILES['userImage']['tmp_name']);
        $imgType = $_FILES['userImage']['type'];
        $sql = "INSERT INTO test(imageType ,imageData) VALUES(?, ?)";
        $statement = $db->prepare($sql);
        $statement->bind_param('ss', $imgType, $imgData);
        $current_id = $statement->execute() or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_connect_error());
    }
}
?>
<HTML>
<HEAD>
<TITLE>Upload Image to MySQL BLOB</TITLE>
<link href="css/form.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
    <form name="frmImage" enctype="multipart/form-data" action=""
        method="post">
        <div class="phppot-container tile-container">
            <label>Upload Image File:</label>
            <div class="row">
                <input name="userImage" type="file" class="full-width" />
            </div>
            <div class="row">
                <input type="submit" value="Submit" />
            </div>
        </div>
        <div class="image-gallery">
            <?php require_once __DIR__ . '/listImages.php'; ?>
        </div>
    </form>
</BODY>
</HTML>