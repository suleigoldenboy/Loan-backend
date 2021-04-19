<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
    Dear {{$data['name']}},<br>
    Congratulations. Your facility has been approved. Your account will be credited shortly. Welcome on board.
    
    <h3>
         Loan ID: {{$data['loan_id']}} <br>
         Approve Date: {{ date('d-m-Y', strtotime($data['date'])) }} <br>
    </h3>

	
</body>
</html>