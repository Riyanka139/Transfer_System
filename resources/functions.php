<?php

//helper function

 function confirm($result){
    global $connection;
    if(!$result){
      die("Query Failed!" . mysqli.error($connection));
    }
  }

  function query($sql){
    global $connection;
    return mysqli_query($connection, $sql);
  }
  
  function escape_string($string){
    global $connection;
    return mysqli_real_escape_string($connection, $string);
  }
  

//get user details function

  function getusers()
  {
	$query = query("select * from user");
	confirm($query);

	$table1 = <<<DELIMETER

		<table id='my_table' class='w-auto' border='2'>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Email Id</th>
				<th>Credit</th>
				<th>Action</th>
			</tr>
DELIMETER;
echo $table1;
		
			while($row = mysqli_fetch_assoc($query))
			{
				$row1= <<<DELIMETER
				<tr>
					<td> {$row['id']} </td>
					<td>{$row['name']} </td>
					<td> {$row['email']} </td>
					<td>{$row['credit']} </td>
					<td><a class='text-white' href='viewuser.php?id={$row['id']} '><button class='btn1'>Transfer Credit</button></a></td>
				</tr>
DELIMETER;
				echo $row1;
			}
			echo "</table>";
  }

//get one user details function

  function user()
  {
	  if(isset($_GET['id'])) 
	  {   	
		  $_SESSION['id'] = escape_string($_GET['id']);
	  }


	  $txt = escape_string($_GET['id']);
	  $query = query("SELECT * FROM user where id='{$txt}' ");
	  confirm($query);
	
    $table2 = <<<DELIMETER
    
	    <table id='my_table' class='w-auto' border='2'>
				<tr>
				  <th>Id</th>
				  <th>Name</th>
				  <th>Email</th>
				  <th>Current Credits</th>
				</tr>
DELIMETER;
	      echo $table2;
  
				while($row = mysqli_fetch_array($query)) 
				{
					$row1 = <<<DELIMETER
					<tr>
						<td>{$row['id']}</td>
						<td>{$row['name']}</td>
						<td>{$row['email']}</td>
						<td>{$row['credit']}</td>
					</tr>
DELIMETER;
					echo $row1;
				}
				echo "</table>";
        return $txt;
  }

//list all user name expect sender

  function option()
  {
	  $txt = escape_string($_GET['id']);
    $query = query("SELECT * FROM user where not id= ".$txt);
    confirm($query);

	  while($row = mysqli_fetch_array($query))
    {
        $get = <<<DELIMETER
		    <option value="{$row['id']}">{$row['name']}</option>
DELIMETER;
		    echo $get;	
     }
				
  }
  
  //get transfer details
  
  function transfer()
  {
    if(isset($_POST['transfer']))
    {
      
      $from_id = escape_string($_POST['from']);
      $to_id = escape_string($_POST['touser']);
      $credits = escape_string($_POST['credits']);  
	
	    $from_query = query("SELECT * FROM user WHERE id='{$from_id}'");
      confirm($from_query);
	    $from_row = mysqli_fetch_assoc($from_query);
	    $from_name = $from_row['name'];
	    $from_credit = $from_row['credit'];
	
	    //Query for user to which credit is transfered
	    $to_query = query("SELECT * FROM user WHERE id='{$to_id}'");
      confirm($to_query);
	    $row_to = mysqli_fetch_assoc($to_query);
      $to_name = $row_to['name'];
      $to_credit = $row_to['credit'];
	
	    if((int)$credits>(int)$from_credit)
      {
          $errors = "Insufficient Credit Balance!!Please Try Again";
            $display = <<<DELIMETER
            <script>
              alert('$errors');
	            window.location.href = 'user.php';
	          </script>
DELIMETER;
            echo $display;
      }
	
	    else
      {
          $current_date = date("Y-m-d H:i:s");
		    
          //from user credits update
          $userf_credit = "UPDATE user SET ";
          $userf_credit .= "Credit = Credit - $credits WHERE id=$from_id";
          $query = query($userf_credit);
          confirm($query);
		
		      //to user credit update
          $userto_credit = "UPDATE user SET ";
          $userto_credit .= "Credit = Credit + $credits WHERE id=$to_id";
          $query = query($userto_credit);
          confirm($query);
	
		      //insert into transcations table
          $query1 = query("INSERT INTO transfer_record(from_user,to_user,credit,datetime) VALUES('$from_name','$to_name','$credits','$current_date')");
          confirm($query1);
		
					$user1 = "SELECT * FROM user WHERE id='$from_id' OR id='$to_id'";
			    $res = query($user1);
          confirm($res);
          
          $table = <<<DELIMETER
          
            <table id='my_table' class='w-auto' border='2'>
		          <tr>
		            <th class="th-sm">Id</th>
		            <th class="th-sm">Name</th>
		            <th class="th-sm">Email Id</th>
		            <th class="th-sm">Credit</th>
		          </tr>
DELIMETER;
          echo $table;
		
     		  while($row = mysqli_fetch_assoc($res))
		      {
		        $row1 = <<<DELIMETER
            <tr>
		          <td>{$row['id']}</td>
		          <td>{$row['name']}</td>
		          <td>{$row['email']}</td>
		          <td>{$row['credit']}</td>
		        </tr>
DELIMETER;
            echo $row1;
		      }
		      echo '</table>' ;
    
        }
    }
     
  }
  
  function history()
  {
    $query = "SELECT * FROM transfer_record";
    $result = query($query);
    confirm($result);
    
    $table = <<<DELIMETER
    
      <table id='my_table' class='w-auto' border='2'>
				<tr>
				  <th class="th-sm">Id</th>
				  <th class="th-sm">From User</th>
				  <th class="th-sm">To User</th>
				  <th class="th-sm">Credit Amount<br>Transfered</th>
				  <th class="th-sm">Date & Time</th>
				</tr>
DELIMETER;
        echo $table;

				while($row = mysqli_fetch_array($result)) 
				{
				$row1 = <<<DELIMETER
        <tbody>
				  <tr>
				    <td>{$row['id']}</td>
				    <td>{$row['from_user']}</td>
				    <td>{$row['to_user']}</td>
				    <td>{$row['credit']}</td>
				    <td>{$row['datetime']}</td>
				  </tr>
        </tbody>
DELIMETER;
          echo $row1;
				}
				echo "</table>";
  }

?>