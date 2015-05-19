/**
 * Created by hjb2722404 on 2015/5/19.
 */
$(function(){
    var oLinks = document.getElementById("tabs").getElementsByTagName("a");
    var oCons = document.getElementById("tabCons").getElementsByTagName("section");
    for(var i = 0; i<oLinks.length; i++){
        oLinks[i].index = i;
        oLinks[i].onclick = function () {
            for(var j =0; j<oLinks.length; j++){
                oLinks[j].className="";
                oCons[j].style.display = "none";
            }
            this.className="cur";
            oCons[this.index].style.display ="block";
        }

    }

});