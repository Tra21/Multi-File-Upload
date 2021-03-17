<!DOCTYPE html>
<html lang="en">
<head>
  <title>Files upload</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container mt-3">
        <div class="image-preview mb-5">
        </div>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="filebrowse" name="files[]" multiple>
            <label class="custom-file-label" for="customFile">Select file</label>
        </div>
        <div class="text-center">
            <button id="upload" class="btn btn-primary">Upload Files</button>
        </div>
        <div class="status">
        
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#filebrowse').change( function(event){
                var split_filepath= $(this).val().split('\\');
                var filename = split_filepath[split_filepath.length-1];
                $('.custom-file-label').text(filename);
                var reader = new FileReader();
                reader.onload = function(){
                    $('.image-preview').append('<img class="pr-2" width="200px" height="200px" src="'+reader.result+'"/>');
                };
                reader.readAsDataURL(event.target.files[0]);
            });
            $('#upload').on('click',function(){
                var arr_img=[];
                $('.image-preview img').each(function(){
                    arr_img.push($(this).attr('src'));
                });
                console.log(arr_img);
                $.ajax({
                    type: 'post',
                    url: 'upload.php',
                    data: {arr_img:arr_img},                         
                    success: function(res){
                        console.log(JSON.parse(res));
                        response = JSON.parse(res);
                        for (let index = 0; index < response.length; index++) {
                            const element = response[index];
                            if(element==0){
                                $('.status').append('<p style="color:red">Image '+element+' error.</p>')
                            }else{
                                $('.status').append('<p style="color:green">Image '+element+' success.</p>');
                            }
                        } 
                    }
                });
            })            
        });

    </script>
</body>
</html>


<?php 

?>