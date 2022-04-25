function getBalance(userId, currency)
{
	$.ajax({
		url: "form/getBalance.php",
		type: "post",
		data: {userId, currency},
		dataType  : 'json',
		success: function (response) {
			$('#balance').html('Баланс: ' + response.balance + ' ' + response.currency.toUpperCase())
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus);
		}
	});
}
$(document).ready(function()
{
	var userId = '';
	var currency = '';

	$('#user').change(function() 
	{
		userId = this.value
		if(userId != '' && currency != '') {
			getBalance(userId, currency)
		}
	});
	$('#currency').change(function() 
	{
		currency = this.value
		if(userId != '' && currency != '') {
			getBalance(userId, currency)
		}
	});
});
