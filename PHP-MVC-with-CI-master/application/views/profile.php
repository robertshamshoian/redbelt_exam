<html>
<head>
	<title>Profile</title>
	<style type="text/css">
	div{
		border: 1px solid black;
		padding: 5px;
		display: inline-block;
	}
	h3{
		display: inline-block;
		margin-right: 350px;
	}
	h4{
		margin-bottom: 5px;
	}
		table{
		border: 2px solid black;
		border-collapse: collapse;
	}
	thead{
		background-color: #CCC;
		font-weight: bold;
	}
	tbody{
		border-right: 1px solid black;
		margin: 0px;
	}
	td{
		border-right: 1px solid black;
		padding:5px;
	}
	tr:nth-child(even) {
		background: lightgray;
	}
	#poke_feed{
		width: 200px;	
	}
	.poke{
		border: 1px solid black;
		text-decoration: none;
		padding: 2px;
		color: black;
	}

	</style>
</head>
<body>
	<br>
	<h4>People you may want to poke:</h4>
		<table>
			<thead>
				<td>Name</td>
				<td>Alias</td>
				<td>Email Address</td>
				<td>Poke History</td>
				<td>Action</td>
			</thead>
			<tbody>
			<?php foreach($users as $user): ?>
				<tr>
					<td><?= $user['name']; ?></td>
					<td><?= $user['alias']; ?></td>
					<td><?= $user['email']; ?></td>
					<td><?= $user['poke_history'].' pokes'; ?></td>
					<td><a class = 'poke' href="/users/poke/<?= $user['id']; ?>">Poke!</a></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
</body>
</html>