
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
		?>
		<li><a href='stats.html'><i class='glyphicon glyphicon-stats'></i> Statistics (Charts)</a></li>
		<li><a href='tables.html'><i class='glyphicon glyphicon-list'></i> Tables</a></li>
		<li><a href='buttons.html'><i class='glyphicon glyphicon-record'></i> Buttons</a></li>
		<li><a href='editors.html'><i class='glyphicon glyphicon-pencil'></i> Editors</a></li>
		<li><a href='forms.html'><i class='glyphicon glyphicon-tasks'></i> Forms</a></li>
	</ul>
</div>

