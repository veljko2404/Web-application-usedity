<?php

  require '../connect.php';
  session_start();
  if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $id = $user['id'];

    $query_messages = "SELECT * FROM `messages` WHERE `id_user`=".$id;
    $query_messgaes_run = mysqli_query($conn, $query_messages);
    if(mysqli_num_rows($query_messgaes_run)>0){
      $messages_num = mysqli_num_rows($query_messgaes_run);
    } else {
        $messages_num = 0;
    }
    
?>
<!DOCTYPE html>
<html lang="en-US">
<head>

  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="css/messages.css" />
  <link rel="icon" sizes="50x50" href="../photos/logo/logo50x50.png">
  <link rel="apple-touch-icon" href="../photos/logo/logo200x200.png">
  <meta name="apple-mobile-web-app-title" content="Usedity">
  <meta name="description" content="Usedity is Web application for selling and buying used cars online." />
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="keywords" content="Search for used cars by: price, year, mileage, state, fuel type, gearbox, doors..." />
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <title>Usedity - Messages </title>
  
    <!--
  
    UU   UU   UUUU  UUUUUUU  UUUUUU    UU  UUUUUUUU  UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU  UU     UU       UU    UU  UU     UU     UU    UU
    UU   UU   UUU   UUUUUU   UU    UU  UU     UU       UUUUUU
    UU   UU     UU  UU       UU    UU  UU     UU           UU
    UU   UU     UU  UU       UU    UU  UU     UU     UU    UU
     UUUUU   UUUU   UUUUUU   UUUUUU    UU     UU      UUUUUU
  
  -->
  
  <!--ICONS-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

  <div class="full-page">

      <div class="header">
    <div class="logo">
      <a href="../index.php"><img src="../photos/logo/logo.png" alt="Logo"></a>
    </div>
    <div class="header-text">
      <script>

      function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
      }

    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>

    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn" id="drpdwn">Profile &#9662;</button>
      <div id="myDropdown" class="dropdown-content">
        <a href="../profile">View profile</a>
        <a href="../profile/logout.php">Log out</a>
        <a href="../">Go back</a>
      </div>
    </div>
    </div>
    <div class="line"></div>
  </div>

      <div class="messages">
          <?php if($messages_num > 0){ ?>
          
            <div>
                <h3 class="posts">Messages (<?php echo $messages_num; ?>)<h3>
            </div>
            <?php while($data = mysqli_fetch_assoc($query_messgaes_run)){ ?>
            <div class="content" id="content<?php echo $data['id']; ?>">
                    <span class="tooltip remove" data-id="<?php echo $data['id']; ?>" id="remove<?php echo $data['id']; ?>">&times;<span class="tooltiptext" id="remTool">Remove</span></span>
                    <p id="mail" style="float:left;">From: <strong><span id="val<?php echo $data['id']; ?>"><a href="mailto:<?php echo $data['email']." "; ?>"><?php echo $data['email']." "; ?></a></span></strong> <div class="tooltip"></p> <i title="copy" onmouseout="outFunc<?php echo $data['id']; ?>()" onclick="copy<?php echo $data['id']; ?>('val<?php echo $data['id']; ?>')" class="fa fa-copy"></i><span class="tooltiptext" id="myTooltip<?php echo $data['id']; ?>">Copy</span></div>
                    <h4>Message: </h4>
                    <p><?php echo $data['message'];?></p>
                    <script>
                            function copy<?php echo $data['id']; ?>(val) {
                                 var copyText = document.getElementById(val).textContent;
                                const el = document.createElement('textarea');
                                el.value = copyText;
                                document.body.appendChild(el);
                                el.select();
                                document.execCommand('copy');
                                document.body.removeChild(el);
                                document.getElementById("myTooltip<?php echo $data['id']; ?>").innerHTML = "Copied";
                          }
                          function outFunc<?php echo $data['id']; ?>() {
                                 var tooltip = document.getElementById("myTooltip<?php echo $data['id']; ?>");
                                 tooltip.innerHTML = "Copy";
                          }
                    </script>
                    <script>
                      $(document).ready(function(){
                        $("#remove<?php echo $data['id']; ?>").click(function(){
                           var id = $(this).data("id");
                           $("#myModal").css("display","block");
                           $("#input-hidden").val(id);
                        });
                        $("#close").click(function(){
                           $("#myModal").css("display","none");
                        });
                      });
                    </script>
            </div>
            <?php } ?>
          <?php } else { ?>
        <div width="100%">
          <h3 class="posts">You haven't recieved any message yet.</h3>
        </div>
        <?php } ?>
      </div>
      <div id="myModal" class="modal">
        
         <div class="modal-content">
             <div class="modal-header">
               <span class="close" id="close">&times;</span>
               <h4>Delete message?</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="input-hidden">
                <button class="btns" style="background-color:#2d9940;" id="yes">Yes</button>
                <button class="btns" style="background-color:#f44336;" id="no">No</button>
                <script>
                
                    $(document).ready(function(){
                       $("#no").click(function(){
                         $("#myModal").css("display","none");  
                       });
                       $("#yes").click(function(){
                         var id = $("#input-hidden").val();
                         var user_id = <?php echo $id; ?>;
                         $.ajax({
                             url:"message_del.php",
                             method:"POST",
                             data:{id:id, user_id:user_id},
                             dataType:"text",
                             success:function(data){
                                 if(data !== ""){
                                     $("#myModal").css("display","none");
                                     $("#content" + id).remove();
                                 } else {
                                     alert("Error occured!");
                                 }
                             }
                         });
                       });
                    });
                
                </script>
            </div>
         </div>

      </div>
<input tpye="text" style="display:none;" />
    <?php require '../footer.php'; ?>

  </div>

</body>
</html>
<?php } else {
  header("Location: ../login");
} ?>