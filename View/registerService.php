<?php 

include_once "../Controller/RegisterController.php";

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autochthonous/Register Service</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Marcellus&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body{
            padding: 1rem;
            font-family: Marcellus, sans-serif;
            text-align:center;
        }

        input{
            padding: 0.6rem;
            font-size: 1rem;
            width: 50%;
            display: block;
            margin:auto;
        }

        form{
            display:flex;
            flex-direction: column;
            gap: 0.6rem;
            width: 100%;
        }

        input[type='submit']{
            color: white;
            background-color: #0d47a1;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 600;
            font-family: Marcellus, sans-serif;
            height: 3.125rem;
            cursor: pointer;
            width: 51.5%;
            margin-top: 1rem;
        }

        textarea {
            width: 50%;
            height: 4rem;
            font-size: 0.9rem;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1>Service Registration</h1>
    <form action="../Controller/RegisterController.php" method="POST">
        <div class="input-div">
            <h3>Name of Service</h3>
            <input type="text" name="name" id="name">
        </div>

        <div class="input-div">
            <h3>Image Source</h3>
            <input type="text" name="img" id="img">
        </div>

        <div class="input-div">
            <h3>Price</h3>
            <input type="number" name="price" id="price">
        </div>

        <div class="input-div">
            <h3>Description of service</h3>
            <textarea id="description" name="description"></textarea>
        </div>
        <input type="submit" name="registerServiceBtn" value="Add Service" onclick={enterData()}>
    </form>

    <script>

        const nameEl = document.getElementById("name");
        const imgEl = document.getElementById("img");
        const priceEl = document.getElementById("price");
        const descriptionEl = document.getElementById("description");

        function enterData() {
            if(nameEl.value == ""){
                alert("Name can't be empty!");
                nameEl.focus();
                event.preventDefault();
            }else if(priceEl.value.length <= 0){
                alert("Price can't be less or equal than 0!");
                priceEl.focus();
                event.preventDefault();
            }else if(imgEl.value == ""){
                alert("Image source can't be empty!");
                imgEl.focus();
                event.preventDefault();
            }else if(descriptionEl.value == ""){
                alert("Description can't be empty!");
                descriptionEl.focus();
                event.preventDefault();
            }else{
                Swal.fire({
                    title: "Service has been Added!",
                    text: "You will now be redirected to the dashboard",
                    icon: "success",
                    timer: 1500
                });
            }
        }

    </script>
</body>
</html>

