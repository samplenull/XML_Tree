<?php
/**
 * index.php
 * Description: main script file for XML-tree generation from any .xml file
 * User: Kai
 * Date: 05.05.11
 * Time: 17:22
 */

// simple upload form
include_once "header.inc";
include_once "XMLTree.php";


if (!isset($_FILES['xmlFilename'])) : ?>

<h1>XML Tree constructor - very test version</h1>
   
    
<form action="index.php" method="POST" enctype="multipart/form-data">
   <label for="xmlFilename">Choose any xml file for upload</label>
    <input type="file" name="xmlFilename" id="xmlFilename" accept="text/xml">
    <input type="submit" name="btnUpload" value="UPLOAD and BUILD TREE please!">

</form>
<?php endif ?>

<!-- test xml parsing-->
<?php

if (isset($_FILES['xmlFilename'])) {
    $file = $_FILES['xmlFilename']['tmp_name'];

    
// toggle links
       echo  '<div id="treecontrol">
<a href="#" title="Collapse the entire tree below"><img src="images/minus.gif">Collapse All</a>
<a href="#" title="Expand the entire tree below">Expand</a>
<a href="#" title="Toggle the tree below, opening closed branches, closing open branches">Toggle All</a>
</div>';
    
    echo '<ul id="browser">';
    $testXML = new XMLTree($file);
    echo $testXML->getTree();
    echo '</ul>';
}
?>
</body></html>