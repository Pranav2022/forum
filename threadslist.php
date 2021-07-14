<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>welcome to iDiscuss - Coding of forums</title>
    <style>
    .media {
        background-color: #eadada;
        padding: 0.5rem
    }

    .media img {
        display: inline;
    }

    .jumbotron {
        background-color: #e6e6e6;
        padding: 3rem
    }

    #que {
        min-height: 600px;
    }

    #que h1 {
        margin: 60px 10px
    }
    </style>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/db_connect.php'; ?>
    <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id = $id";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_desc'];
        }
    ?>
    <?php
    $ShowAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
       echo $method;
       if ($method == 'POST') {
           $th_title=$_POST['title'];
           $th_desc=$_POST['desc'];
           $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `dt`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
           $result = mysqli_query($conn , $sql);
           if (!$result) {
               echo"Inserting the info failed";
           }
           else {
               echo"Insersion successful!";
           }
           $ShowAlert = true;
           if ($ShowAlert) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Question Posted!</strong> Your thread has been added please wait for our community to respond
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
           }
       }

    ?>
    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4">welcome to
                <?php echo $catname; ?> forum
            </h1>
            <p class="lead">
                <?php echo $catdesc; ?>
            </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other</p>
            <a class="btn btn-primary btn-success" href="#" role="button">Learn more</a>
        </div>
    </div>
    <div class="container my-5 py-2">
    <h1>Start a Disscussion</h1>
    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Problem title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Elaborate your Problem</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
    </form>
    </div>
    <div class="container my-5 py-2" id="que">
        <h1>Browse - Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
        $result = mysqli_query($conn , $sql);
        $NoResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $NoResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $comment_time = $row['dt'];
            echo  ' <div class="media my-3">
            <img src="img/customer-logo - Copy.png" width="40px" class="mr-3" alt="...">
            <p class="font-weight-bold  mt-0 my-0">Anonymous User at '. $comment_time .'</p>
            <h5 class="mt-0"> <a href = "threads.php?threadid='. $id .'" class ="text-dark" style="text-decoration:none">'. $title .'</a></h5>
            <div class="media-body">
                <p>'. $desc .'</p>
            </div>
        </div>';
        }

        echo var_dump($NoResult);
        if ($NoResult) {
            echo'<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-4">No result found</p>
              <p class="lead">Be the first person to ask a question.</p>
            </div>
          </div>';
        }
    ?>

        
        <!-- template for card  -->
        <!-- <div class="media my-3">
            <img src="img/customer-logo - Copy.png" width="40px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0">Unable to download pyaudio in windows</h5>
                <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's
                    beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is
                    jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
            </div>
        </div> -->

    </div>







    <?php include 'partials/footer.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>