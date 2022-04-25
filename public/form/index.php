<?php 
session_start();
use App\Models\User;
use App\Database\Database;

$database = new Database();
$user = new User($database->getConnection());

$users = $user->getAll();
?>
<style>
	[data-tooltip] 
	{
		position: relative;
	}
	[data-tooltip]::after 
	{
		content: attr(data-tooltip);
		position: absolute;
		width: 300px;
		left: 0; top: 0;
		background: #3989c9;
		color: #fff;
		padding: 0.5em;
		box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
		pointer-events: none;
		opacity: 0;
		transition: 1s;
	} 
	[data-tooltip]:hover::after 
	{
		opacity: 1;
		top: 2em;
	}
</style>
<form action="\form\handler.php" method="POST">
	<?php 
	if($_SESSION['result'])
	{
		echo "<div class='form-group'>";
		echo "<span class='text-success text-bold'>";
		echo $_SESSION['result'];
		echo "</span>";
		echo "</div>";
		unset($_SESSION['result']);
	}
	?>
	<div class="form-group">
		<label for="user">Выберите пользователя</label>
		<select class="form-control" id="user" name="user_id" required/>
		<option disabled selected hidden></option>
		<?php
		foreach ($users as $user) 
		{
			echo "<option value='$user[id]'>$user[name]</option>";
		}
		?>
	</select>
</div>
<div class="form-group">
	<label for="currency">Выберите валюту</label>
	<select class="form-control" id="currency" name="currency" required/>
	<option disabled selected hidden></option>
	<option value="usd">USD</option>
	<option value="eur">EUR</option>
	<option value="rub">RUB</option>
</select>
</div>
<div class="form-group">
	<span id="balance" class="font-weight-bold">
		Баланс: 0
	</span>
</div>
<div class="form-group">
	<label for="sum"><p style="margin:0" data-tooltip="Сумма ставки должна
		быть в пределах от 1 до 500 текущих денежных единиц.">Сумма ставки</p></label>
		<input type="number" value="" class="form-control" id="sum" name="sum" placeholder="0" required/>
	</div>
	<?php 
	if($_SESSION['error'])
	{
		echo "<div class='form-group'><span class='text-danger'>$_SESSION[error]</span></div>";
		unset($_SESSION['error']);
	}
	?>
	<table class="table table-striped table-dark text-center">
		<thead>
			<tr>
				<th scope="row">Матч#</th>
				<th scope="col">Команды</th>
				<th scope="col">Победа первой команды</th>
				<th scope="col">Ничья</th>
				<th scope="col">Победа второй команды</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<th>Red Wings - Chicago Blackhawks</th>
				<td>2.50</td>
				<td>3.05</td>
				<td>3.15</td>
			</tr>
			<tr>
				<th scope="row">2</th>
				<th>Colorado Avalanche - Calgary Flames</th>
				<td>1.45</td>
				<td>3.45</td>
				<td>5.87</td>
			</tr>
		</tbody>
	</table>
	<div class="form-group">
		<label for="match_result">Исход матча</label>
		<select class="form-control" id="match_result" name="ratio" required/>
		<option disabled selected hidden></option>
		<option value="2.50">Матч# 1 Победа Red Wings</option>
		<option value="3.05">Матч# 1 Ничья</option>
		<option value="3.15">Матч# 1 Победа Chicago Blackhawks</option>
		<option value="1.45">Матч# 2 Победа Colorado Avalanche</option>
		<option value="3.45">Матч# 2 Ничья</option>
		<option value="5.87">Матч# 2 Победа Calgary Flames</option>
	</select>
</div>
<div class="form-group">
	<label for="bet_result">Исход ставки</label>
	<select class="form-control" id="bet_result" name="bet_result" required/>
	<option disabled selected hidden></option>
	<option value="1">Победа</option>
	<option value="0">Проигрыш</option>
</select>
</div>
<button type="submit" class="btn btn-success">Подтвердить</button>
</form>

<script src="form/js/getBalance.js"></script>