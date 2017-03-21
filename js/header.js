var headerTxt="<div class='sidebar content-box' style='display: block;'>";
headerTxt+="<ul class='nav'><li class='current'><a href='index.html'><i class='glyphicon glyphicon-home'></i> Dashboard</a></li>";
headerTxt+="<li><a href='calendar.html'><i class='glyphicon glyphicon-calendar'></i> Calendar</a></li>";
headerTxt+="<li><a href='stats.html'><i class='glyphicon glyphicon-stats'></i> Statistics (Charts)</a></li>";
headerTxt+="<li><a href='tables.html'><i class='glyphicon glyphicon-list'></i> Tables</a></li>";
headerTxt+="<li><a href='buttons.html'><i class='glyphicon glyphicon-record'></i> Buttons</a></li>";
headerTxt+="<li><a href='editors.html'><i class='glyphicon glyphicon-pencil'></i> Editors</a></li>";
headerTxt+="<li><a href='forms.html'><i class='glyphicon glyphicon-tasks'></i> Forms</a></li>";
headerTxt+="<li class='submenu'>";
headerTxt+="<a href='#'><i class='glyphicon glyphicon-list'></i> Pages<span class='caret pull-right'></span></a>";
headerTxt+="<ul><li><a href='login.html'>Login</a></li><li><a href='signup.html'>Signup</a></li></ul></li></ul></div>";

$("#divmenu").html(headerTxt);