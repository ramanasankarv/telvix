
<div class='sidebar content-box' style='display: block;'>
	<ul class='nav'>
		<?php if($page=="index")
			echo "<li class='current'><a href='index.php'><i class='glyphicon glyphicon-home'></i> Dashboard</a></li>";
			else
				echo "<li><a href='index.php'><i class='glyphicon glyphicon-home'></i> Dashboard</a></li>";
		if($page == "channel")
			echo "<li class='current'><a href='channel.php'><i class='glyphicon glyphicon-hd-video'></i> Channel</a></li>";
		else
			echo "<li><a href='channel.php'><i class='glyphicon glyphicon-hd-video'></i> Channel</a></li>";
		

		?>
		
	</ul>
</div>

