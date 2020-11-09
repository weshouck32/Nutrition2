<?php include "header.php"; ?>
<?php
  $brands = db_get_results("SELECT DISTINCT(Brand_Name) from nutrition WHERE Brand_Name != '' ORDER BY Brand_Name ASC");
  $categories = db_get_results("SELECT DISTINCT(Category) from nutrition ORDER BY Category ASC" );
  $ingredients = db_get_results("SELECT DISTINCT(Ingredients) from nutrition");

  echo "<pre>";
  $category_list = array();
  foreach ($categories as $category) {
    $category_string = $category['Category'];
    $category_string = explode('>', $category_string);
    array_shift($category_string);
    array_pop($category_string);
    $category_string = implode(">", $category_string);
    $category_list[] = $category_string;
  }
  $category_list = array_unique($category_list);
  $category_list = array_filter($category_list);


  //print_r($category_list);
  echo "</pre>";
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<div class="hero py-5">
<div class="container">
<h1 class="f0">Bootstrap Icons</h1>
<p class="mb-4 f3 font-weight-normal">For the first time ever, Bootstrap has its own icon library, custom designed and built for our components and documentation—and now available for any project.</p>
<hr class="my-4">
</div>
</div>
<style>
* {
    margin: 0;
    padding: 0;
}
.full-width {
    width: 100%;
    min-width: 100%;
    max-width: 100%;
}
</style>
<main class="container full-width" id="content" role="main">
  <div class="row">
    <div class="col-md-2">
      Clear All Filters
      <div class="bs-example">
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i> Categories</button>
              </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="radio">
                  <?php foreach ($category_list as $category) { ?>
                    <label>
                      <input type="radio" name="category" id="category1" value="<?php echo $category; ?>" checked>
                      <?php echo $category; ?>
                    </label>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-plus"></i> Brands</button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>Bootstrap is a sleek, intuitive, and powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-plus"></i> Ingredients</button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
    <div class="col-md-10">
      <table id="nutrition_info" class="display" style="width:100%">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Image</th>
            <th>Carbohydrates</th>
            <th>Fats</th>
            <th>Protein</th>
            <th>Calories</th>
            <th>Ingredients</th>
            <th>Serving Size</th>
            <th>Brand</th>
            <th>Categories</th>
            <th>Upc_Number</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Product Name</th>
            <th>Image</th>
            <th>Carbohydrates</th>
            <th>Fats</th>
            <th>Protein</th>
            <th>Calories</th>
            <th>Ingredients</th>
            <th>Serving Size</th>
            <th>Brand</th>
            <th>Categories</th>
            <th>Upc_Number</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</main>
<?php include "footer.php"; ?>
<script>
  $(document).ready(function() {
    $('#nutrition_info').DataTable( {
      "processing": true,
      "serverSide": true,
      "ajax": "server_data.php",
        "columnDefs": [
          {
              width: 200,
              "targets": 0
          },
          {
              "render": function ( data, type, row ) {
                  image = 'https://www.kroger.com/product/images/xlarge/front/' + row[10];
                  return '<img src="'+ image + '" height="100" />';
                  //return data +' ('+ row[3]+')';
              },
              "targets": 1
          },
          {
              width: 200,
              "render": function ( data, type, row ) {
                  return '<span style="font-size: 12px;">' + data + '"</span>';
                  //return data +' ('+ row[3]+')';
              },
              "targets": 6
          },
          { "visible": false,  "targets": [ 8, 9, 10 ] }
      ]
  } );
} );
</script>
<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
