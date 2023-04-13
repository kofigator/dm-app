<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="script.js"></script>
</head>
<body>
	<header>
		<h1>Dashboard</h1>
	</header>
	<nav>
		<ul>
			<li><a href="#" class="active">Customers</a></li>
			<li><a href="#">Products</a></li>
			<li><a href="#">POS</a></li>
			<li><a href="#">Reports</a></li>
		</ul>
	</nav>
	<section>
		<div id="customers" class="tabcontent">
			<h2>Customers</h2>
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>John Smith</td>
						<td>john@example.com</td>
						<td>555-1234</td>
						<td><a href="#">Edit</a> | <a href="#">Delete</a></td>
					</tr>
					<tr>
						<td>2</td>
						<td>Jane Doe</td>
						<td>jane@example.com</td>
						<td>555-5678</td>
						<td><a href="#">Edit</a> | <a href="#">Delete</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div id="products" class="tabcontent">
			<h2>Products</h2>
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Price</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Product A</td>
						<td>$10.00</td>
						<td><a href="#">Edit</a> | <a href="#">Delete</a></td>
					</tr>
					<tr>
						<td>2</td>
						<td>Product B</td>
						<td>$15.00</td>
						<td><a href="#">Edit</a> | <a href="#">Delete</a></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div id="pos" class="tabcontent">
			<h2>POS</h2>
			<p>Point of Sale content goes here.</p>
		</div>
		<div id="reports" class="tabcontent">
			<h2>Reports</h2>
			<p>Reports content goes here.</p>
		</div>
	</section>
	<footer>
		<p>&copy; 2023 Dashboard Inc.</p>
	</footer>
</body>
</html>
