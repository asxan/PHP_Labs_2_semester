
; function animate(duration) {    
    var element = document.getElementById("animated");
    var fps = 60;
    var x1 = -350;
    var x2 = 0;
    //var positionY = 0;//-350;
    var duration = 3000.0;
    //var k = 1 / duration;        
    var t0 = new Date();//skolko 



    //mnogo
    var intervalID = setInterval(frame, 1000.0 / fps);
    function frame() {
        var elp = new Date();//10
        var delta = elp.getTime() - t0.getTime();
        var k = delta / duration;
        var coord;
        if (k > 1) {
            k = 1;
            coord = func(k);
            element.style.backgroundPositionY = coord + "px";
            clearInterval(intervalID);
            animate1(1);
        }
        else {
            coord = func(k);
            element.style.backgroundPositionY= coord + "px";
        }
    };
    ; function func(k) {
        //return x = x1 + (x2 - x1) *(Math.sin(k*360)); //Math.pow(x, 1/3);//180 / (x + 1) * Math.sin(x);
        return x = x1 + (x2 - x1) * (Math.sqrt(k)); 
    }
};

; function animate1(duration) {
    var element = document.getElementById("animated1");
    var fps = 60;
    var x1 = -400;
    var x2 = 0;
    //var positionY = 0;//-350;
    var t = 1500.0;
    //var k = 1 / duration;        
    var t0 = new Date();
    var intervalID = setInterval(frame, 1000.0 / fps);
    function frame() {
        var elp = new Date();
        var delta = elp.getTime() - t0.getTime();
        var k = delta / t;
        var coord;
        if (k > 1) {
            k = 1;
            coord = func(k);
            element.style.backgroundPositionY = coord + "px";
            clearInterval(intervalID);
        }
        else {
            coord = func(k);
            element.style.backgroundPositionY = coord + "px";
        }
    };
    ; function func(k) {
        return x = x1 + (x2 - x1) * (Math.sqrt(k)); //Math.pow(x, 1/3);//180 / (x + 1) * Math.sin(x);
    }
};
