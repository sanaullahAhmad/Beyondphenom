prototypefabric;
var r = 0;
var color = "brown";
var front = "";
var back = "";
var front_count = 0;
var back_count = 0;
var current = "";
var prototypefabric = new function() {
    var canvas = new fabric.Canvas('mycanvas', {
        width: 1020,
        height: 500,
        backgroundColor: 'white'
    });
    fabric.Object.prototype.transparentCorners = false;
    this.loadPattern = function(url) {
        var curSelectedObjects = canvas.getObjects();
        canvas.discardActiveGroup();
        fabric.util.loadImage(url, function(img) {
            for (var i = 0; i < curSelectedObjects.length; i++) {
                var obj = curSelectedObjects[i];
                console.log(obj);
                if (obj.class == "text") {
                    obj.fill = new fabric.Pattern({
                        source: img
                    });
                    canvas.renderAll();
                }
            }
        });
    }
    this.addText = function(_text, options, id) {
            //var self = this;
            var text = new fabric.Text(_text || 'Enter Your Text Here', {
                left: (options && options.left) || canvas.getWidth() / 3,
                top: (options && options.top) || canvas.getHeight() / 4,
                width: (options && options.width) || 200,
                height: (options && options.height) || 200,
                textAlign: 'center',
                class: 'text',
                fill: 'black',
                fontSize: 48,
                fontFamily: 'Times New Romans',
                id: id,
                opacity: (options && options.opacity) || 1,
                scaleX: (options && options.scaleX) || 1,
                scaleY: (options && options.scaleY) || 1,
                target: (options && options.target) || false,
                selectable: (options && options.selectable) || true,
                hasControls: (options && options.opacity) || true,
                hasRotatingPoint: (options && options.hasRotatingPoint) || true,
                lockMovementX: (options && options.lockMovementX) || false,
                lockMovementY: (options && options.lockMovementY) || false,
                lockRotation: (options && options.lockRotation) || false,
                lockScalingX: (options && options.lockScalingX) || false,
                lockScalingY: (options && options.lockScalingY) || false
            });
            //text.setCoords();
            canvas.add(text);
            //loadPattern('img/download.jpg');
            canvas.setActiveObject(text);
            canvas.renderAll();
        }
        // this.addsvg = function(src) {
        //         fabric.loadSVGFromURL(src, function(objects, options) {
        //             var obj = fabric.util.groupSVGElements(objects, options);
        //             console.log(obj);
        //             obj.set({
        //                 class: "svg",
        //                 scaleX: 0.4,
        //                 scaleY: 0.4,
        //                 // width:50,
        //                 // height:50,
        //                 left: 175,
        //                 top: 100
        //             });
        //             canvas.add(obj).renderAll();
        //         });
        //     }
    this.addsvg = function(site_url) {
        var site_url = 'http://fabricjs.com/assets/1.svg';
        fabric.loadSVGFromURL(site_url, function(objects) {
            var group = new fabric.PathGroup(objects, {
                left: 165,
                top: 100,
                width: 295,
                class: 'svg',
                height: 211
            });
            canvas.add(group);
            canvas.renderAll();
        });
    }
    this.loadPatternsvg = function(src) {
        fabric.util.loadImage(src, function(img) {
            var pattern = new fabric.Pattern({
                source: img,
                repeat: 'repeat'
            });
            var obj = canvas.getActiveObject();
            console.log(obj);
            if (!obj) return;
            if (obj instanceof fabric.PathGroup) {
                obj.getObjects().forEach(function(o) {
                    o.fill = pattern;
                });
            }
            canvas.renderAll();
        })
    }
    this.addImage = function(source) {
        var Left = canvas.width / 2;
        var Top = canvas.height / 2;
        fabric.Image.fromURL(source, function(img) {
            img.class = 'image';
            img.source = source;
            img.id = "test";
            img.originX = "center";
            img.originY = "center";
            img.top = Top - 30;
            img.left = Left - 20;
            img.width = 100;
            img.height = 100;
            console.log(img.width);
            canvas.add(img);
            canvas.renderAll();
        });
    }
}