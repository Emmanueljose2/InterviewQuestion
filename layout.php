<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="layout.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body class="background">
<form method="POST">
    <div class="header">
    <div class="h1" >
        <h1 class="head">PEOPLE DATA</h1><button class="but" name="nextPerson">Next Person</button>
    </div>
   

<?php
session_start(); 
 if (!isset($_SESSION['displayedData'])|| !is_array($_SESSION['displayedData'])) {
    $_SESSION['displayedData'] = array();
}

    
    $jsonData = file_get_contents('data.json');
    $data = json_decode($jsonData, true);
    
    if (isset($_POST['nextPerson'])) {
$currentIndex = $_SESSION['currentIndex'];

        if ($currentIndex < count($data)) {
            $person = $data[$currentIndex];
            $_SESSION['displayedData'][] = $person;
            // Increment the current index for the next click
            $_SESSION['currentIndex']++;
        } else {
            // If all data has been displayed, reset to the beginning
            $_SESSION['currentIndex'] = 0;
            $_SESSION['displayedData'] = array();
            echo '<script>alert("All data has been displayed.");</script>';
        }

}
if (!empty($_SESSION['displayedData'])) {
    $count=1;
foreach ($_SESSION['displayedData'] as $displayedPerson) {
    if ($displayedPerson === null) {
        continue; // Skip over NULL elements
    }
    
    ?>
     <div>
        <div class="data">
            <div class="data1"><div class="count"><?php echo $count; ?></div></div>
            <div class="data2">
                <div class="data3"><span class="name">Name:</span><?php echo $displayedPerson['name']?></div>
         <span class="name"> Location:</span><?php echo $displayedPerson['location']?>
        </div>
        
    </div>
    
    <?php
    $count++;
    
}
?>
<p><div class="count1">CURENTLY <?php echo $count-1 ?> PEOPLE SHOWING </div></p>

<?php }

?>
</div>
</form> 
</body>
</html>
