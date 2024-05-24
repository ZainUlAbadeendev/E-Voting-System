<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b>Not Voted</b>';
    }
    else{
        $status = '<b>Voted</b>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Voting</title>
    <link rel="stylesheet" href="../css/stylesheet3.css">
</head>
<body>
    <div id="headerSection">
    <a href="../"><button id="backbtn">Back</button></a>
    <a href="logout.php"><button id="logoutbtn">Log Out</button></a>
    <h1>E Voting System</h1>
    </div>
    <br>
    <div id="mainpanel">
    <div id="Profile">
    <img src="../uploads/<?php echo $userdata['photo']?>" height="240" width="200"><br><br><br><br>
    <b>Name:  </b><?php echo $userdata['name']?><br><br><br>
    <b>Mobile:  </b><?php echo $userdata['mobile']?><br><br><br>
    <b>Address:  </b><?php echo $userdata['address']?><br><br><br>
    <b>Status:  </b><?php echo $status?><br><br><br>
    </div>

    <div id="Group">
        <?php
        if($_SESSION['groupsdata']){
            for($i=0; $i<count($groupsdata); $i++){
                ?>
                <div>
                    <img src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                    <b>Group Name:  </b><?php echo $groupsdata[$i]['name']?><br><br>
                    <b>Votes:  </b><?php echo $groupsdata[$i]['votes']?>
                    <form action="../api/vote.php" method="POST">
                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                        <?php 
                        if($_SESSION['userdata']['status']==0){
                        ?>
                        <input type="submit" name= "votebtn" value="Vote" id="votebtn">
                        <?php
                        }
                        else{
                            ?>
                        <button disabled type="button" name= "votebtn" value="Vote" id="voted"></button> 
                        <?php
                        }
                        ?>
                    </form>
                </div>
                <?php
            }
        }
        else{

        }
        ?>
    </div>
    </div>
</body>
</html>
