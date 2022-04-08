<?php
$poids_max = 3000000;
$upload_directory = "../upload/";
$error = 0;

if (isset($_FILES['image']) && $_FILES['image']['error']==0){

    if ($_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/jpg' ){

        if ($_FILES['image']['size'] < $poids_max){

            $nom_image = time().$_FILES['image']['name'];

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_directory.$nom_image)) { 
                $error = 4;
                $url = $upload_directory.''.$nom_image.''; 
                chmod($upload_directory.$nom_image, 0777);   
            } 
            else 
            { 
            $error =3;
            }      
        }
        else {
            $error = 2;
         
        }
    }
    else {
       $error = 1;
    
    }
}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Hebergeur d'image</title>
</head>
<body>
<div class="flex justify-center items-center mx-auto h-screen">
        <div class="border-2 border-solid border-gray-400 p-8 rounded-lg m-auto shadow-2xl">
            <p class="text-center text-white text-3xl p-8 border-2 border-solid shadow border-gray-400 rounded bg-blue-600">Hébergez votre image</p>

            <?Php 
                    if ($error ==4){?>
                        <div class="text-center text-red-600 text-sm p-1" >Votre image à été uplodée sans problème sur le serveur</div>
                        <div class="flex justify-center">
                        <img src="<?php echo $upload_directory.$nom_image ?>" alt="image uplodée" class="p-1 max-h-fit h-60"/>
                        </div>
                        <div class="text-center">
                        <a href="<?php echo $upload_directory.$nom_image ?>" class="text-sm text-blue-600 p-1" target="_blank"> Lien vers votre image</a>
                        </div>
                        <?php }
                    
                    if ($error ==1){?>
                    <div class="text-center text-red-600 text-sm p-1" >Les fichiers doivent êtres de type .png, .jpeg ou .jpg.</div>
                    <?php }
                    if ($error ==2){?>
                        <div class="text-center text-red-600 text-sm p-1" >Les fichiers doivent faire moins de 3 Mo.</div>
                        <?php }
                    if ($error ==3){?>
                        <div class="text-center text-red-600 text-sm p-1" >Le fichier n'a pas pu être sauvegardé sur le serveur .</div>
                        <?php }
            ?>

            <form class="text-center p-4" action="" method="POST" enctype="multipart/form-data">

                <div class="">
                    <label for="image" class="text-lg p-2">Choisir une image</br></label>
                    <input class="my-2" type="file" name="image" id="image" placeholder=" " />
                    
                </div>
                <div class="border-2 border-solid border-x-gray-400 rounded-md mt-6 bg-blue-600">
                        <button type="submit" class="text-white p-1">Envoyer</button>
                </div>
               
            </form>
            
        </div>
    </div>
</body>
</html>

