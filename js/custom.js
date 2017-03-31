$(document).ready(function(){


  $(".submenu > a").click(function(e) {
    e.preventDefault();
    var $li = $(this).parent("li");
    var $ul = $(this).next("ul");

    if($li.hasClass("open")) {
      $ul.slideUp(350);
      $li.removeClass("open");
    } else {
      $(".nav > li > ul").slideUp(350);
      $(".nav > li").removeClass("open");
      $ul.slideDown(350);
      $li.addClass("open");
    }
  });
  
});

var BrowserDetect = {
  init: function () {
    this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
    this.version = this.searchVersion(navigator.userAgent)
      || this.searchVersion(navigator.appVersion)
      || "an unknown version";
    this.OS = this.searchString(this.dataOS) || "an unknown OS";
  },
  searchString: function (data) {
    for (var i=0;i<data.length;i++) {
      var dataString = data[i].string;
      var dataProp = data[i].prop;
      this.versionSearchString = data[i].versionSearch || data[i].identity;
      if (dataString) {
        if (dataString.indexOf(data[i].subString) != -1)
          return data[i].identity;
      }
      else if (dataProp)
        return data[i].identity;
    }
  },
  searchVersion: function (dataString) {
    var index = dataString.indexOf(this.versionSearchString);
    if (index == -1) return;
    return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
  },
  dataBrowser: [
    {
      string: navigator.userAgent,
      subString: "Chrome",
      identity: "Chrome"
    },
    {   string: navigator.userAgent,
      subString: "OmniWeb",
      versionSearch: "OmniWeb/",
      identity: "OmniWeb"
    },
    {
      string: navigator.vendor,
      subString: "Apple",
      identity: "Safari",
      versionSearch: "Version"
    },
    {
      prop: window.opera,
      identity: "Opera",
      versionSearch: "Version"
    },
    {
      string: navigator.vendor,
      subString: "iCab",
      identity: "iCab"
    },
    {
      string: navigator.vendor,
      subString: "KDE",
      identity: "Konqueror"
    },
    {
      string: navigator.userAgent,
      subString: "Firefox",
      identity: "Firefox"
    },
    {
      string: navigator.vendor,
      subString: "Camino",
      identity: "Camino"
    },
    {   // for newer Netscapes (6+)
      string: navigator.userAgent,
      subString: "Netscape",
      identity: "Netscape"
    },
    {
      string: navigator.userAgent,
      subString: "MSIE",
      identity: "Explorer",
      versionSearch: "MSIE"
    },
    {
      string: navigator.userAgent,
      subString: "Gecko",
      identity: "Mozilla",
      versionSearch: "rv"
    },
    {     // for older Netscapes (4-)
      string: navigator.userAgent,
      subString: "Mozilla",
      identity: "Netscape",
      versionSearch: "Mozilla"
    }
  ],
  dataOS : [
    {
      string: navigator.platform,
      subString: "Win",
      identity: "Windows"
    },
    {
      string: navigator.platform,
      subString: "Mac",
      identity: "Mac"
    },
    {
         string: navigator.userAgent,
         subString: "iPhone",
         identity: "iPhone/iPod"
      },
    {
      string: navigator.platform,
      subString: "Linux",
      identity: "Linux"
    }
  ]


};


function play_channel(chno,container,dvr_on,g_token,url)
{
  var vlc;
  var vlc_id;
  var flash_video_window;
  var path;
  var video_path;
  var browser_name;
  var str;
  var pos1;
  var browser_name;

  var hostname="5.9.101.139";
  
  var httpport = "18000";
  g_token="0.160220,4.388885";
  var  cgi_url;
  var d=new Date();
  var VideoWindow;

  bQuery_Channel_Status=0;
  
  
  BrowserDetect.init();
  browser_name=BrowserDetect.browser;
  if (container.search("flv")>=0)
  {   
    //video_path="http://"+hostname+":"+httpport+"/ch"+chno+"."+container+'?token='+g_token+':server_ip_port='+hostname+":"+httpport;
    video_path=url;
      
  } 
  else if (container.search("ch")>=0)
  {
    if (browser_name.search("Safari")==0)
    { // Apple  
      //video_path="http://"+hostname+":"+httpport+"/ch"+chno+"."+"m3u8"+'?token='+g_token+':server_ip_port='+hostname+":"+httpport;
      video_path=url;
    } else
      { // VLC 
      //video_path="http://"+hostname+":"+httpport+"/"+chno+"."+container+'?token='+g_token+':server_ip_port='+hostname+":"+httpport;
      video_path=url;
      }
  }
    g_video_path=video_path;
  // alert(video_path);
  //g_current_timestamp=0;
  //g_dvr_timestamp=0;
  //bdvr_on=0;
   str="<head><title>CH "+chno+"</title>"+'</head><body>';
  //str='';
  if (container.search("flv")>=0)
  {
    if (browser_name.search("Explorer")==0)
    {
      str+='<object>'+
      '<param name="allowFullScreen" value="true" />'+
      '<param name="allowscriptaccess" value="always" />'+
      '<embed src="http://'+hostname+':'+httpport+'/flash_player10_1/StrobeMediaPlayback.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="300" height="220" flashvars="src='+video_path+'&autoPlay=true">'+ 
      '</embed>'+
      '</object>';  
    } else 
    {
      str+='<param name="allowFullScreen" value="true"></param>'+
      '<param name="allowscriptaccess" value="always"></param>'+
      '<embed src="http://'+hostname+':'+httpport+'/flash_player10_1/StrobeMediaPlayback.swf" autoplay="yes" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="300" height="220" flashvars="src='+video_path+'&autoPlay=true">';
    
  
    }
  }else if (browser_name.search("Safari")==0)
  { // APPLIE
    //alert(video_path);
    str+='<video src="http://trtcanlitv-lh.akamaihd.net/i/TRT1HD_1@181842/index_1500_av-b.m3u8?sd=10&rebase=on" controls autoplay>';
      //alert(str);

  }else if (container.search("ch")>=0) 
  { // VLC
      
     if (browser_name.search("Explorer")==0)
     {
      str+='<OBJECT id="VIDEO" width="100%" height="100%" CLASSID="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" type="application/x-oleobject">'+
      '<PARAM NAME="URL" VALUE="'+video_path+'">'+
      '<PARAM NAME="AutoStart" VALUE="True">'+
      '</OBJECT>';
       
    }else
    {

      str+='<embed type="application/x-vlc-plugin" name="player" autoplay="yes" loop="no" '+
      'target="'+video_path+'">';
    }   

  }
  // $('#channel-modal').modal('show');
  // $('#channel-modal .modal-dialog .modal-content').html(str);
  str+='</body>';
  
  VideoWindow= window.open("", "", "top=100, left=100, width=320, height=240"); 
  VideoWindow.document.write(str); 

  //flash_video_window=document.getElementById("flash_video_window");

  //alert(str);
  
  
}

function play_movie(movie_no,container,dvr_on,g_token,url)
{
   var movie_src_id="moviesrc"+movie_no; 
   var movie_src_name="moviename"+movie_no; 
  var movie_src;
   var movie_name;
  var vlc;
  var vlc_id;
  var flash_video_window;
  var path;
  var video_path;
  var browser_name;
  var str;
  var pos1;
  var browser_name;
   g_item_name=document.getElementById(movie_src_id);
   movie_src = g_item_name.value;
   g_item_name=document.getElementById(movie_src_name);
   movie_name = g_item_name.value;
 
  var httpport = 18000;
  var hostname = "http://5.9.101.139/";

  var  cgi_url;
  var d=new Date();
  var VideoWindow;

  //cgi_url= "/server/query_dvr_starting_time?token="+escape(g_token)+ "&ch_no=" +chno+"&flag="+Math.random();
  
  BrowserDetect.init();
  browser_name=BrowserDetect.browser;
  video_path="http://"+hostname+":"+httpport+"/"+movie_name+'?token='+g_token+':server_ip_port='+hostname+":"+httpport;
    g_video_path=video_path;
  //alert(video_path);
  //g_current_timestamp=0;
  //g_dvr_timestamp=0;
  //bdvr_on=0;
   str="<head><title>Movie "+movie_no+"</title></head><body>";
//  str='';
//alert(movie_src);
  if (container.search("flv")>0)
  {
    
    if (browser_name.search("Explorer")==0)
    {

      str+='<object>'+
      '<param name="allowFullScreen" value="true" />'+
      '<param name="allowscriptaccess" value="always" />'+
      '<embed src="/flash_player10_1/StrobeMediaPlayback.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="300" height="220" flashvars="src='+video_path+'&autoPlay=true">'+ 
      '</embed>'+
      '</object>';  
      
    } else 
    {
      
      
      str+='<param name="allowFullScreen" value="true"></param>'+
      '<param name="allowscriptaccess" value="always"></param>'+
      '<embed src="/flash_player10_1/StrobeMediaPlayback.swf" autoplay="yes" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="300" height="220" flashvars="src='+video_path+'&autoPlay=true">';
      
    
  
    }
    
  }else if (url.search("mp4")>0)
  { // APPLIE
    str+='<video src="'+video_path+'" controls autoplay>';
      //alert(str);

  }else if (url.search("ts")>0) 
  { // VLC
      
     if (browser_name.search("Explorer")==0)
     {
      str+='<OBJECT id="VIDEO" width="100%" height="100%" CLASSID="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" type="application/x-oleobject">'+
      '<PARAM NAME="URL" VALUE="'+video_path+'">'+
      '<PARAM NAME="AutoStart" VALUE="True">'+
      '</OBJECT>';
       
        }else
    {
      str+='<embed type="application/x-vlc-plugin" name="player" autoplay="yes" loop="no" '+
      'target="'+video_path+'">';
    }   

  }
  
  str+='</body>';
  
  
   VideoWindow= window.open("", "", "top=100, left=100, width=320, height=240"); 
  VideoWindow.document.write(str); 

  
  
}



