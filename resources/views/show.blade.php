<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	@foreach($blacklist as $elem)
	{{$elem->name}}
	@endforeach

</body>
</html>