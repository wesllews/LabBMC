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

<!-- Pagination-->
<?php pagination($sql,$header); ?>


<!--Container-->
<div class="container-fluid">

  <div class="row justify-content-center">

    <div class="col-12">
      <button class="btn btn-warning text-white px-4" data-toggle="collapse" data-target="#filtro">
        <i class="fas fa-filter"></i>
      </button>
    </div>
    
    <!--Col Form-->
    <div class="col-md-2 float-left collapse bg-secondary text-white p-3" id="filtro">
      <form action="studbook.php" method="get" target="_self" >

      <div class="form-group">
        <label>Items per page</label>

        <select name="limit" class="form-control form-control-sm">
            <?php for ($i=20; $i <= 200; $i+=20):?>
              <option <?php echo isset($_GET['limit']) && $_GET['limit']==$i ? "selected":""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
      </div>

      <div class="form-row">

        <div class="col">
          <label>Date Start</label>
          <input class="datapicker form-control form-control-sm" type="date" name="startDate" value="<?php echo $array['startDate']; ?>">
        </div>

        <div class="col">
          <label>Date End</label>
          <input class="datapicker form-control form-control-sm" type="date" name="endDate" value="<?php echo $array['endDate']; ?>" >
        </div>

      </div>

      <div class="form-group">
        <label>Sex</label>

        <select name="sex" class="form-control form-control-sm">
          <option <?php echo !isset($_GET['sex']) ? "selected":"";?> value="" >Select...</option>
          <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Female" ? "selected":""; ?> value="Female">Female</option>
          <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Male" ? "selected":""; ?> value="Male">Male</option>
          <option <?php echo isset($_GET['sex']) && $_GET["sex"]=="Unknown" ? "selected":""; ?> value="Unknown">Unknown</option>
        </select>
      </div>

      <div class="form-group">
        <label>Institutes</label>

        <select name="institute" class="form-control form-control-sm">
          <option <?php echo !isset($_GET['institute']) ? "selected":""; ?> value="">Select...</option>
          <?php 
          $sql_institute = "SELECT * FROM institute";
          $query = $mysqli->query($sql_institute);

          while ($row = $query->fetch_array()):?>
            <option <?php echo isset($_GET['institute']) && $_GET['institute']==$row["id"] ? "selected":""; ?> value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-warning">Submit</button>
      <a class="btn btn-warning" href="studbook.php" role="button">Clear All</a>
      </form>
    </div>

    <!--Col Table-->
    <div class="col-md-10 float-left">
      <!--Table Responsive-->
      <div class="table-responsive">
        <?php table($sql,$header); ?>       
      </div>
    </div>
  </div>

</div>
<!--Container-->


<!-- Pagination-->
<?php pagination($sql,$header); ?>

<?php include 'footer.php'; ?>