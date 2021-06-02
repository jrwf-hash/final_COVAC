<?php
	$title = $_REQUEST["title" ];
	$content = $_REQUEST["content" ];
	$timestamp = strtotime("+1 days");
	
	if ($title && $content) {
		try {
			require("covacDB.php");
			
			$day = date("Y-m-d H:i:s", $timestamp);
			
			$db->exec("insert into Epilogue (title, content, day, view)
						values ('$title', '$content', '$day', 0)");
		} catch (PDOException $e) {
			exit($e->getMessage());
		}
		
		header("Location:board.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<script>
	alert('모든 항목이 빈칸 없이 입력되어야 합니다.');
	history.back();
</script>
</body>
</html>