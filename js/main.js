var myIndex = 0;
carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        // x = x.length;
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 2000);    
        }

        
var myIndex1 = 0;
carousel1();

function carousel1() {
        var j;
        var x1 = document.getElementsByClassName("mySlides1");
        // x1 = x1.length;
        for (j = 0; j < x1.length; j++) {
            x1[j].style.display = "none";  
        }
        myIndex1++;
        if (myIndex1 > x1.length) {myIndex1 = 1}    
        x1[myIndex1-1].style.display = "block";  
        setTimeout(carousel1, 1500);    
        }