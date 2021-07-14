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
               $posted = false;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $comment = $_POST['comment'];
                $id = $_GET['threadid'];
                $sql = "INSERT INTO `comments` (`comment_content`, `comment_thread_id`, `commentdt`) VALUES ('$comment', '$id', current_timestamp())";
                $result = mysqli_query($conn , $sql);
                $posted = true;
                if ($posted) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Comment Posted!</strong> Your comment has been added thanks for your support
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
            }


    ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
        }
    ?>
    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?> </p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other</p>
            <p><strong>posted by pranav</strong></p>
        </div>
    </div>
   
    <div class="container my-5 py-2">
        <h1>Post a comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type a comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post Your comment</button>
        </form>
    </div>
    <div class="container my-5 py-2" id="que">
        <h1>Disscussion</h1>
        <?php
        $sql = "SELECT * FROM `comments` WHERE comment_thread_id =$id ";
        $result = mysqli_query($conn , $sql);
        $NoResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $NoResult = false;
            $id = $row['comment_id'];
            $reply = $row['comment_content'];
            $comment_time = $row['commentdt'];
            echo  ' <div class="media my-3">
            <img src="img/customer-logo - Copy.png" width="40px" class="mr-1" alt="...">
            <div class="media-body">
            <p class="mt-0 my-0 text-dark">Anonymous User at '. $comment_time .'</p>
                <p>'  . $reply .' </p>
            </div>
        </div>';
        }
        if ($NoResult) {
            echo'<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-4">No comment</p>
              <p class="lead">Be the first person to reply or solution to  this query.</p>
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