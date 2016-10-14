<!DOCTYPE html>
<html>
<head>
<meta charset="windows-1256">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<title>Test Api Website</title>
</head>
<body>

<script type="text/javascript">

$.get( "../handler.php?op_id=0", function(data){
    document.write(data);
});


</script>

</body>
</html>