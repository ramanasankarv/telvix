var headerTxt="<div class='sidebar content-box' style='display: block;'>";
headerTxt+="<ul class='nav'><li class='current'><a href='index.html'><i class='glyphicon glyphicon-home'></i> Dashboard</a></li>";
headerTxt+="<li class='submenu'>";
headerTxt+="<a href='#'><i class='glyphicon glyphicon-list'></i> Channel<span class='caret pull-right'></span></a>";
headerTxt+="<ul><li><a href='channel.php'>Manage Channel</a></li><li><a href='channelgroup.php'>Channel Group</a></li></ul></li>";
headerTxt+="<li><a href='stats.html'><i class='glyphicon glyphicon-stats'></i> Statistics (Charts)</a></li>";
headerTxt+="<li><a href='tables.html'><i class='glyphicon glyphicon-list'></i> Tables</a></li>";
headerTxt+="<li><a href='buttons.html'><i class='glyphicon glyphicon-record'></i> Buttons</a></li>";
headerTxt+="<li><a href='editors.html'><i class='glyphicon glyphicon-pencil'></i> Editors</a></li>";
headerTxt+="<li><a href='forms.html'><i class='glyphicon glyphicon-tasks'></i> Forms</a></li>";
headerTxt+="</ul></div>";

$("#divmenu").html(headerTxt);