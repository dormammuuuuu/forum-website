<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
   <title>Untitled Document</title>
   <style>
    body{
        font-family: Poppins;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #232423;
        color: #ffffff;
    }

    p{
        font-weight: bolder;
        color: #ffffff;
    }
    .numbers{
        padding: .5em;
        border-radius: 7px;
        border:none;
    }
    .options{
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    .option{
        padding: .5em;
        border-radius: 7px;
        border:none;
    }
    .option:hover{
        background-color: #42a842;
    }
    </style>
 </head>
 <?php 

$num1 = '';
$num2 = '';
$calc = '';

if (isset($_POST['submit']))
{
  $num1 = $_POST['n1'];
  $num2 = $_POST['n2'];
  $calc =  calculate($num1, $num2, $_POST['submit']);
}

function calculate($num1,$num2,$op) 
{
 $calc = '';

 switch ($op) 
 {
      case 'Addition':   
              $calc = $num1 + $num2;
          break;
      case 'Subtraction':
              $calc = $num1 - $num2;
          break;
      case 'Multiplication':
          $calc = $num1 * $num2;
          break;
      case 'Division':
          $calc = $num1 / $num2;
          break;
 }

 return $calc;

}
?>


 <body>
     <h1 id="title">SeatWork 3 - Simple Calculator using switch case</h1>
    <form action="" method="post">
      <p>Nunmber 1: </p> <input  name='n1' class="numbers"  placeholder="Enter a number" value="<?php echo $num1;?>">
       <br><br>
       <p>Nunmber 2: </p> <input  name='n2' class="numbers" placeholder="Enter a number" value="<?php echo $num2;?>"><br><br>
       <p>Total: </p> <input name="res" class="numbers"  value="<?php echo $calc;?>"><br><br>

       <div class="options">
       <input type="submit" class="option"  name="submit" value="Addition">
       <input type="submit" class="option"  name="submit" value="Subtraction">
       <input type="submit" class="option"  name="submit" value="Multiplication">
       <input type="submit" class="option"  name="submit" value="Division">
        </div>
   </form>
 </body>
</html>