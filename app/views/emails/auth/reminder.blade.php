<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div style="background-color: #428bca; color:#fff; padding:10px;">
			To reset your password, complete this form: <a style="color:#fff" href="{{ URL::to('password/reset', array($token)) }}">{{ URL::to('password/reset', array($token)) }}</a>
		</div>
	</body>
</html>