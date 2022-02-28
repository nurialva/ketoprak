<?php
define ( "ABSPATH" , dirname(__FILE__) );
require_once __DIR__ . "/autoload.php";
require_once __DIR__ . "/vendor/autoload.php";
if (!empty($_GET['id'])): $book_id = $_GET['id'];
$book_id_new = $book_id;
if ( $book_id < 900 ) { $book_id_new = mt_rand (); }
$data2  = file_get_contents("https://borobuku.com/quick_find.php?id={$book_id_new}");

?>
     <!DOCTYPE html>
     <html lang="en" dir="ltr">
          <head>
               <meta charset="utf-8">
               <title>Powerfull Tools</title>
          </head>
          <body class="container" >
               <?php
               if ( $data2 == "not exist") {
                    echo "<p>There are no book with this ID</p>";
               }
               else {
                    echo "<p>Current Book with this ID</p>";
               }

                ?>
               <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
               <form action="https://borobuku.com/handler.php" method="post"  >
                    <div class="image">
                    </div>
                    <div class="title">
                    </div>
                    <div class="authorname">
                    </div>
                    <div class="appenddata">
                    </div>
                    <div class="lib_detail">
                         <input type="text" name="library" value="Perpustakaan UIN Sunan Ampel Surabaya">
                         <input type="text" name="book_id" value="<?php echo $book_id_new; ?>">
                    </div>
                    <div class="fixed-action-btn">
                         <button type="submit" class="btn-floating btn-large red" name="add">Add</button>
                    </div>
               </form>
               <?php
               $data  = file_get_contents("http://catalog.uinsby.ac.id/index.php?p=show_detail&id={$book_id}");
               $mystring = 'abc';
               $findme   = 'Data not found!';
               $pos = strpos($data, $findme);

               if ($pos !== false) {
                    echo "The book is not exist";
               }

                ?>
               <div class="hidethis">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
               <?php
               var_dump($data);
               ?>
               <script>
               var final_array = [];
               $('dl dt').each(function(){
                  var dt_dds = [];   /* array to hold the dt_dds */
                  dt_dds.push( $(this).text() );  /* push the dt */
                  dds = $(this).nextUntil('dt'); /* get all dd's until the next dt */
                  dds.each(function(){  dt_dds.push( $(this).text() )}); /** push all dd's into the array*/
                  final_array.push( dt_dds );
               })
               for (var i = 0; i < final_array.length; i++) {
                    var classname = final_array[i][0].replace(/ /, "_");
                    var classname = classname.replace(/ /, "_");
                    var classname = classname.replace(/ /, "_");
                    var classname = classname.replace(/ /, "_");
                    var classname = classname.replace("/", "_");
                    var classname = classname.toLowerCase();
                    $('.appenddata').append("<div><label>"+final_array[i][0]+"</label><input type='text' name='"+classname+"' value='"+final_array[i][1]+"' /></div><br>");
               }

               var dataDDDDDD = $(".blockquote-footer").text();
               $('.authorname').append("<div><label>Penulis</label><br><input type='text' name='authorname' value='"+dataDDDDDD+"' /></div><br>");
               var datatitle = $( "h4" ).first().text();
               $('.title').append("<div><label>Judul</label><br><input type='text' name='title' value='"+datatitle+"' /></div><br>");

               var img = $("img").eq(1).attr('src');
               var img = img.replace("&width=200", "&width=240");
               var img = "http://catalog.uinsby.ac.id/" + img;
               $('.image').append('<input type="hidden" name="cover" value="'+img+'" /><img width="240" src="'+img+'"> <p>Image name "'+img+'"</p>');
               </script>
               <?php var_dump($_SESSION); ?>
               <style media="screen">
                    .hidethis { display: none;}
               </style>
               </div>

          </body>
     </html>

<?php else: ?>
     <?php if ( isset ( $_POST['add'])) {
          $raw_url = explode("&" , $_POST['val']);
          $ids = explode("id=" , $raw_url[1]);
          header("location:http://localhost:8080/autools.php?id=".$ids[1]);
     } ?>
     <form class="/autools.php?id=" action="" method="post">
          <input type="text" name="val" value="">
          <input type="submit" name="add" value="add">
     </form>
     <?php if (!empty($_GET['startwith'])): ?>
          <?php

          $strt = $_GET['startwith'] - 9;
          $stfr = $_GET['startwith'] + 1;
          for ($i=$strt; $i < $stfr; $i++) {
               echo "<p><a href='/autools.php?id={$i}' target='_blank'>Go Rock!</a></p>";
               $data  = file_get_contents("http://catalog.uinsby.ac.id/index.php?p=show_detail&id={$i}");
               $findme   = 'Data not found!';
               $pos = strpos($data, $findme);

               if ($pos !== false) {
                    echo "Repository : The book is not exist";
               }

               $data2  = file_get_contents("https://borobuku.com/quick_find.php?id={$i}");
               if ( $data2 == "not exist") {
                    echo "<p>Borobuku : There are no book with this ID</p>";
               }
               else {
                    echo "<p>Borobuku : Book with this ID exist</p>";
               }

               echo "<hr>";
          }

           ?>
     <?php endif; ?>
<?php endif; ?>
