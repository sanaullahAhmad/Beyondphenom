prototypefabric;
var r = 0;
var color = "#2aace2";
var front = "";
var back = "";
var front_count = 0;
var back_count = 0;
var current = "";
var prototypefabric = new function() {
    var canvas = new fabric.Canvas('mycanvas', {
        width: 520,
        height: 580,
        backgroundColor: 'white'
    });
    canvas.clipBackground = false;
    canvas.clipOverlay = false;
    canvas.controlsAboveOverlay = true;
    canvas.renderAll();
    
    this.createOverlay_front = function(_src) {
        if (current == "back" || front_count == 0) {
            back = JSON.stringify(canvas);
            if (front_count > 1) {
                console.log(JSON.parse(front));
            }
            canvas.forEachObject(function(obj) {
                canvas.fxRemove(obj);
            });
            if (front_count == 0) {
                var testimage = new Image();
                testimage.onload = function() {
                    shirtimage = new fabric.Image(testimage, {
                        originX: 'left',
                        originY: 'top',
                        src: _src,
                        width: 100,
                        height: 120,
                        scaleX:0.2,
                        scaleY:0.,
                        top: 120,
                        left: 150,
                        class: "overlay"
                    });
                    shirtimage.top = 0;
                    shirtimage.left = 0;
                    shirtimage.scaleX = 1;
                    shirtimage.scaleY = 1;
                    shirtimage.setCoords();
                    canvas.setBackgroundColor(color);
                    canvas.setOverlayImage(_src, shirtimage, canvas.renderAll.bind(canvas));
                    setTimeout(function() {
                        canvas.renderAll();
                    }, 100);
                }
                testimage.src = _src;
            }
            if (front_count > 0) {
                this.load(front);
                console.log(front);
            }
            canvas.setBackgroundColor('white');
            front_count++;
            current = "front";
        }
    }
}