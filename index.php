<?php
$directories = glob('Samples/*' , GLOB_ONLYDIR);
if(isset($_GET["i"])) {
    $theinput = $_GET["i"];
} else {
    $theinput = "";
}
echo "<html>";
?>

<head>
<title>QB64 Resource Homepage (2022)</title>
<meta name="description" content="QB64 Resource Homepage (2022), Sample Programs" />
<script type="text/javascript"></script>
<link rel="stylesheet" href="stylesqb.css">
<link rel="icon" href="favicon.ico">
</head>

<?php
echo "<body>";
?>

<center>
<div class="container">
  <div class="alignleft">
    <div class="title">
      QB64 Resource Homepage
    </div>
  </div>
</div>
</center>

<center>
<div class="container">
  <div class="alignright">
    <div class="subtitle">
      Sample Programs
    </div>
  </div>
  <br/><br/>
  <hr/>
</div>
</center>

<center>
<div class="container">
  <br/>
  <img src="Qb64.png">
  <br/><br/>
</div>
</center>

<?php if ($theinput == "") { ?>

<center>
<div class="container" style="text-align:left">
<?php foreach ($directories as $folder) {
  $tags = file_get_contents($folder . "/tags.txt");
  echo "<a href=\"index.php?i=" . $folder . "\">" . $folder . "</a><div class=\"alignright\">" . $tags . "</div><br/><br/>";
} ?>
</div>
</center>

<?php } else { ?>

<?php
$srcbulk = scandir($theinput."/src");
$imgbulk = scandir($theinput."/img");
?>

<center>
<div class="container"> <div class="subtitle"> <?php echo substr($theinput, 8); ?> </div> </div>
</center>

<center>
<div class="container" style="text-align:left">
<h2>Meta</h2>
<?php foreach (explode("\n", file_get_contents($theinput . "/meta.txt")) as $metadat) {
  echo $metadat . "<br/>";
} ?>
</div>
</center>

<center>
<div class="container" style="text-align:left">
<h2>Download</h2>
<ul>
<?php foreach ($srcbulk as $srcfile) {
  if (($srcfile != ".") & ($srcfile != "..")) {
     echo "<li><a href=\"" . $theinput . "/src/" . $srcfile . "\">" . $srcfile . "</a></li>";
  }
} ?>
</ul>
</div>
</center>
  
<center>
<div class="container" style="text-align:left">
<h2>Description</h2>
<?php foreach (explode("\n", file_get_contents($theinput . "/description.txt")) as $descdat) {
  echo $descdat . "<br/>";
} ?>
</div>
</center>

<center>
<div class="container" style="text-align:left">
<h2>Source</h2>
<?php foreach ($srcbulk as $srcfile) {
  if (($srcfile != ".") & ($srcfile != "..")) {
    $file_info = pathinfo($srcfile);
    $file_extension = $file_info['extension'];
    if (strtoupper($file_extension) == "BAS") {
      echo $srcfile . "<br/>";
      ?>
      <textarea id="" class="console" cols="90" rows="15"><?php echo file_get_contents($theinput . "/src/" . $srcfile); ?> </textarea>
      <br/><br/>
      <?php
    }
  }
} ?>
</div>
</center>

<center>
<div class="container" style="text-align:left">
<h2>Screenshots</h2>
<?php foreach ($imgbulk as $imgfile) {
  if (($imgfile != ".") & ($imgfile != "..")) {
    $pth = $theinput . "/img/" . $imgfile;
    if(@is_array(getimagesize($pth))){
      echo "<img src=\"" . $pth . "\"</a><br/><br/>";
    }
  }
} ?>
</div>
</center>

<?php }
echo "</body>";
echo "</html>";
?>