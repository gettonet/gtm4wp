"use strict";"undefined"==typeof console&&(window.console={log:function(){}}),jQuery(function(e){var t,o=gtm4wp_scrollerscript_debugmode,n=gtm4wp_scrollerscript_callbacktime,r=gtm4wp_scrollerscript_readerlocation,l=0,i=!1,a=!1,c=!1,m=(new Date).getTime();function d(){bottom=e(window).height()+e(window).scrollTop(),height=e(document).height(),bottom>r&&!i&&(currentTime=new Date,scrollStart=currentTime.getTime(),timeToScroll=Math.round((scrollStart-m)/1e3),o?console.log("Started reading "+timeToScroll):window[gtm4wp_datalayer_name].push({event:"gtm4wp.reading.startReading",timeToScroll:timeToScroll}),i=!0),bottom>=e("#"+gtm4wp_scrollerscript_contentelementid).scrollTop()+e("#"+gtm4wp_scrollerscript_contentelementid).innerHeight()&&!a&&(currentTime=new Date,contentScrollEnd=currentTime.getTime(),timeToContentEnd=Math.round((contentScrollEnd-scrollStart)/1e3),o?console.log("End content section "+timeToContentEnd):window[gtm4wp_datalayer_name].push({event:"gtm4wp.reading.contentBottom",timeToScroll:timeToContentEnd}),a=!0),bottom>=height&&!c&&(currentTime=new Date,end=currentTime.getTime(),t=Math.round((end-scrollStart)/1e3),o?(t<gtm4wp_scrollerscript_scannertime?console.log('The visitor seems to be a "scanner"'):console.log('The visitor seems to be a "reader"'),console.log("Bottom of page "+t)):(t<gtm4wp_scrollerscript_scannertime?window[gtm4wp_datalayer_name].push({event:"gtm4wp.reading.readerType",readerType:"scanner"}):window[gtm4wp_datalayer_name].push({event:"gtm4wp.reading.readerType",readerType:"reader"}),window[gtm4wp_datalayer_name].push({event:"gtm4wp.reading.pagebottom",timeToScroll:t})),c=!0)}o?console.log("Article loaded"):window[gtm4wp_datalayer_name].push({event:"gtm4wp.reading.articleLoaded"}),e(window).scroll(function(){l&&clearTimeout(l),l=setTimeout(d,n)})});