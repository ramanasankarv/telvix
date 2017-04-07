
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
		if($page == "movie")
			echo "<li class='current'><a href='movie.php'><i class='glyphicon glyphicon-facetime-video'></i> Movie</a></li>";
		else
			echo "<li><a href='movie.php'><i class='glyphicon glyphicon-facetime-video'></i> Movie</a></li>";
		if($page == "user")
			echo "<li class='current'><a href='user.php'><i class='glyphicon glyphicon-user'></i> Users</a></li>";
		else
			echo "<li><a href='user.php'><i class='glyphicon glyphicon-user'></i> Users</a></li>";

		if($page == "group")
			echo "<li class='current'><a href='group.php'><i class='glyphicon glyphicon-user'></i> Group</a></li>";
		else
			echo "<li><a href='group.php'><i class='glyphicon glyphicon-user'></i> Group</a></li>";

		if($page == "egp")
			echo "<li class='current'><a href='egp.php'><i class='glyphicon glyphicon-user'></i> EPG</a></li>";
		else
			echo "<li><a href='egp.php'><i class='glyphicon glyphicon-user'></i> EPG</a></li>";

		?>
		
	</ul>
</div>

