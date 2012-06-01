jQuery(document).ready(function() {

  jQuery("ul.share a").click(function(event){
    var windowOptions = "scrollbars=yes,resizable=yes,toolbar=no,location=yes",
        url = jQuery(this).attr("href"),
        width = 550,
        height = 420,
        winHeight = screen.height,
        winWidth = screen.width,
        left = Math.round((winWidth / 2) - (width / 2)),
        top = 0;

    if (winHeight > height) {
      top = Math.round((winHeight / 2) - (height / 2));
    }
    
    window.open(url, 'share', windowOptions + ',width='+width+',height='+height+',left='+left+',top='+top);
    event.preventDefault();    
  });
	
});
