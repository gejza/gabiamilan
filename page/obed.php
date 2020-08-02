    <div class="card">zatímco my budeme s rodinou baštit, vy se můžete jen podívat na některou z těchto památek:</div>
    <div class="card"><a href="http://www.hrad-valdstejn.cz/">Hrad Valdštejn</div>
    <div class="card"><a href="https://www.cesky-raj.info/dr-cs/1253-zamek-hruba-skala.html">Zámek Hrubá Skála</div>
    <div class="card"><a href="https://www.cesky-raj.info/dr-cs/710-hruboskalsko.html">Hruboskalsko</div>
    <div class="card"><a href="https://www.cesky-raj.info/dr-cs/687-klokocske-skaly.html">Klokočské skály</div>
    <div class="card"><a href="https://www.cesky-raj.info/dr-cs/1344-hrad-trosky.html">Hrad trosky</div>


    <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>

<?php
$link = mysqli_connect("md84.wedos.net", 'a251653_sv1', 'Svatba_228', 'd251653_sv1');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Attempt select query execution
$sql = "SELECT * FROM tips";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){

            echo ('<pre>');
            var_dump($row);
            echo ('</pre>');

            /*echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";*/
        }
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>

  <!-- START THE FEATURETTES -->

  <hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">hrad Valdštejn <span class="text-muted">It'll blow your mind.</span></h2>
    <p class="lead">Valdštejn (Waldstein) je zřícenina v okrese Semily blízko Turnova, v oblasti Českého ráje. Rodový hrad pánů z Valdštejna pochází z druhé poloviny 13. století. Je jedním z nejstarších hradů v tomto kraji.</p>
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-responsive center-block" src="/img/tip/valdstejn.jpg" alt="Hrad Valdštejn">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 col-md-push-5">
    <h2 class="featurette-heading">Zámek Hrubá Skála</h2>
    <p class="lead">Romantický zámek byl postaven na pískovcových skalách na místě středověkého hradu ze 14. století. Je jednou z dominant Českého ráje. Ze zámecké věže se nabízí krásný výhled na okolní krajinu.</p>
  </div>
  <div class="col-md-5 col-md-pull-7">
    <img class="featurette-image img-responsive center-block" src="/img/tip/hruba-skala.jpg" alt="Hruba Skala">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
    <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
  </div>
</div>

<hr class="featurette-divider">

<!-- /END THE FEATURETTES -->