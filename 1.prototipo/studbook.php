<?php
session_start();
$_SESSION['pagina']='studbook';
include 'header.php';

require_once 'db.class.php';

$header = ['identification','name','sex','events','date','institute','local_id'];
$array = get_all($header);
forms($header);

$sql= "SELECT identification, individual.name as name, sex, events, date, institute.name as institute, local_id FROM `individual`
                  INNER JOIN historic ON individual.identification=historic.id_individual 
                  INNER JOIN events ON historic.id_event=events.id
                  INNER JOIN institute ON historic.id_institute=institute.id
                  WHERE id_category!=2 and (events.events='Birth' OR events.events='Capture')
                  "; #ORDER BY CAST(identification AS int) ASC

// Filtros
$startDate = $array['startDate']!="" ? " AND date >= CAST('$array[startDate]' AS DATE)":"";
$endDate = $array['endDate']!="" ? " AND date <= CAST('$array[endDate]' AS DATE)":"";
$sex = $array['sex']!="" ? " AND sex='$array[sex]'":"";
$institute = $array['institute']!="" ? " AND institute.id = '$array[institute]'":"";


$sql .= $startDate.$endDate.$sex.$institute;
?>




<form action="studbook.php" method="get" target="_self" class="form-inline bg-secondary p-3">

  <!-- Items per page -->
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">Items per page</div>
    </div>
    <select name="limit" class="custom-select">
      <?php for ($i=20; $i <= 100; $i+=20):?>
        <option <?php echo isset($_GET['limit']) && $_GET['limit']==$i ? "selected":""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
      <?php endfor; ?>
        <option <?php echo isset($_GET['limit']) && $_GET["limit"]=="all" ? "selected":""; ?> value="all">All</option>
      </select>
  </div>

    <!-- Date Start -->
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">Start</div>
    </div>
    <input class="datapicker form-control" type="date" name="startDate" value="<?php echo $array['startDate']; ?>">
  </div>

  <!-- Date End -->
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">End</div>
    </div>
    <input class="form-control" type="date" name="endDate" value="<?php echo $array['endDate']; ?>" >
  </div>

  <!-- Items per page -->
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">Sex</div>
    </div>
    <select name="sex" class="custom-select">
      <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Female" ? "selected":""; ?> value="Female">Female</option>
      <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Male" ? "selected":""; ?> value="Male">Male</option>
      <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Unknown" ? "selected":""; ?> value="Unknown">Unknown</option>
    </select>
  </div>

  <!-- Institutes -->
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">Institutes</div>
    </div>
    <select name="institute" class="custom-select">
      <?php 
      $sql_institute = "SELECT * FROM institute";
      $query = $mysqli->query($sql_institute);

      while ($row = $query->fetch_array()):?>
        <option <?php echo isset($_GET['institute']) && $_GET['institute']==$row["id"] ? "selected":""; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
      <?php endwhile; ?>
      </select>
  </div>

  <!-- Submit -->
  <div class="form-group ml-auto"> <!-- Submit button -->
    <button type="submit" class="btn btn-warning mr-2">Submit</button>
    <button type="reset" class="btn btn-warning mr-2">Reset</button>
  </div>
  
</form>


<!-- Pagination-->
<?php pagination($sql,$header); ?>


<!--Container-->
<div class="container">
  
  <!--Table Responsive-->
  <div class="table-responsive-lg">
    <?php table($sql,$header); ?>       
  </div>
</div>
<!--Container-->


<!-- Pagination-->
<?php pagination($sql,$header); ?>

<?php include 'footer.php'; ?>