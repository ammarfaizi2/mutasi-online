<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script type="text/javascript">
    function preview_image(gambar,idpreview){
        var gb = gambar.files;
        for (var i = 0; i < gb.length; i++){
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);            
            var reader  = new FileReader();
            if (gbPreview.type.match(imageType)) {
                preview.file = gbPreview;
                reader.onload = (function(element) {
                    return function(e) {
                        element.src = e.target.result;
                    };
                })(preview);
                reader.readAsDataURL(gbPreview);
            }else{
                alert("Type file tidak sesuai!");
            }
        }    
    }
    </script>
</head>
<body>
<?php
if (isset($_FILES['wq'])) {
 var_dump($_FILES);
}
?>
<form id="myForm" action="" method="post" enctype="multipart/form-data">
    <input type="file" accept="image/jpeg,image/jpg"  onchange="preview_image(this,'preview')" name="wq" />
    <input type="submit" value="Upload" /><br/>
    <img id="preview" src="" alt="" width="320px"/>
</form>
</body>
</html>