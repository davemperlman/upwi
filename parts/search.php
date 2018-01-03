<?php
?>
<a class="close" href="#">Back</a>

<form>
 	<h2>Search Jobs</h2>
 	Search By 
  <div>
    <input type="radio" name="searchMethod" value="invoice" id="invoice">
    <label for="invoice">Invoice</label>
    <input type="radio" name="searchMethod" value="name" id="name">
    <label for="name">Customer</label>
    <input type="radio" name="searchMethod" value="id" id="jobId">
    <label for="jobId">Job</label>
  </div>

 	<input type="text" id="search" placeholder="search">
  <button type="submit">Submit</button>
 	<br>
 	<div id="display">
 		
 	</div>
 </form>
 <script type="text/javascript">
 	function fill(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#search').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display').hide();
}
 
$(document).ready(function() {
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
   $("#search").keyup(function() {
      var method = $("input[name=searchMethod]:checked").val();
       //Assigning search box value to javascript variable named as "name".
       var name = $('#search').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display").html("");
       }
       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "parts/searchQuery.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   search: name,
                   method: method
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "search.php" file.
                   $("#display").html(html).show();
               }
           });
       }
   });
});

	$('.close').on('click', function(e){
        e.preventDefault();
        $('.offscreen-window').removeClass('slide-in');
        $('.offscreen-window').empty();
    });
</script>