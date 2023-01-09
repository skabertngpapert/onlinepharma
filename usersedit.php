<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Accounts </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<body style="width:100vw">

    <!-- Modal -->
    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/database/insertuser.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="uname" class="form-control" placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="password" class="form-control" placeholder="Enter Password">
                        </div>

                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="usrname" class="form-control" placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Email">
                        </div>
						<div class="form-group">
                            <label> Phone Number </label>
                            <input type="number" name="phone" class="form-control" placeholder="Enter Phone Number">
							
                        </div>
						<div class="form-group">
                            <label> Cart Items </label>
                            <input type="text" name="cart" class="form-control" placeholder="Enter Cart Items">
                        </div>
						<div class="form-group">
                            <label> Cart Items Quantity </label>
                            <input type="text" name="itemqty" class="form-control" placeholder="Enter Cart Items Quantity">
                        </div>
						<div class="form-group">
                            <label> User Level </label>
                            <input type="text" name="level" class="form-control" placeholder="Enter User Level">
                        </div>
						<div class="form-group" style="text-align: right;float: right; margin-left: auto;">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        	<button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit User Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="database\userupdate.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="uname" class="form-control" placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="password" class="form-control" placeholder="Enter Password">
                        </div>

                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="usrname" class="form-control" placeholder="Enter Name">
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="email" class="form-control" placeholder="Enter Email">
                        </div>
						<div class="form-group">
                            <label> Phone Number </label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
							
                        </div>
						<div class="form-group">
                            <label> Cart Items </label>
                            <input type="text" name="cart" class="form-control" placeholder="Enter Cart Items">
                        </div>
						<div class="form-group">
                            <label> Cart Items Quantity </label>
                            <input type="text" name="itemqty" class="form-control" placeholder="Enter Cart Items Quantity">
                        </div>
						<div class="form-group">
                            <label> User Level </label>
                            <input type="text" name="level" class="form-control" placeholder="Enter User Level">
                        </div>
						<div class="form-group" style="text-align: right;float: right; margin-left: auto;">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" name="updatedata" id="bt_edit" class="btn btn-primary">Update Data</button>
                        </div>
						
                    </div>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Account Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="database/userdelete.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


   

    <div class="container">
        <div class="jumbotron">
            <div class="card">
			
        
            <div class="card-body">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="navbar-brand" href="/admin.php">Admin Panel</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto">
						<li class="nav-item active">
							<a class="nav-link" href="/admin.php">Products <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/usersedit.php">Users</a>
						</li>
						</ul>
						<ul class="navbar-nav justify-content-right" style="text-align: right;float: right; margin-left: auto;">
						<li class="nav-item mr-1"><a href="logout.php" class="nav-link">Logout</a></li>
					</div>
				</nav>

            </div>
		
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                        ADD NEW USER
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body overflow-auto">

                    <?php
                $connection = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($connection, 'pharmacy');

                $query = "SELECT * FROM accounts";
                $query_run = mysqli_query($connection, $query);
            ?>
                    <table id="datatableid" class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th scope="col"> ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password </th>
                                <th scope="col"> Name </th>
                                <th scope="col"> Email </th>
								<th scope="col"> Phone </th>
								<th scope="col"> Cart </th>
								<th scope="col"> Cart Items Quantity </th>
								<th scope="col"> Level </th>
                                <th scope="col"> EDIT </th>
                                <th scope="col"> DELETE </th>
                            </tr>
                        </thead>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $row['usrId']; ?> </td>
                                <td> <?php echo $row['usrUname']; ?> </td>
                                <td> <?php echo $row['usrPassword']; ?> </td>
                                <td> <?php echo $row['usrName']; ?> </td>
                                <td> <?php echo $row['usrEmail']; ?> </td>
								<td> <?php echo $row['usrPhone']; ?> </td>
								<td> <?php echo $row['usrCart']; ?> </td>
								<td> <?php echo $row['usrItemQty']; ?> </td>
								<td> <?php echo $row['usrLevel']; ?> </td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                </td>
                            </tr>
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
                    </table>
                </div>
            </div>


        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>



    <script>
        $(document).ready(function () {
			

            $('#datatableid').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Your Data",
                }
            });

        });
    </script>

    <script>
        $(document).ready(function () {
			
            $('.deletebtn').on('click', function () {
                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>

    <script>
        $(document).ready(function () {
			// $('#').modal({
			// 	backdrop: 'static',
			// 	keyboard: false
			// });

			$("#btn_edit").on('click', function(){
				console.log("ako si archie");
			});
            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
				
                console.log(data);


                $('#update_id').val(data[0]);
                $("#editmodal input[name='uname']").val(data[1]);
                $("#editmodal input[name='password']").val(data[2]);
                $("#editmodal input[name='usrname']").val(data[3]);
                $("#editmodal input[name='email']").val(data[4]);
				$("#editmodal input[name='phone']").val(data[5]);
                $("#editmodal input[name='cart']").val(data[6]);
				$("#editmodal input[name='itemqty']").val(data[7]);
                $("#editmodal input[name='level']").val(data[8]);
            });
        });


		
    </script>

		
</body>
</html>