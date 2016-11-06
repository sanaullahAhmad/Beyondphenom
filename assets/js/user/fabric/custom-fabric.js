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
        width: 400,
        height: 400,
        backgroundColor: 'white'
    });
    fabric.Object.prototype.transparentCorners = false;
    canvas.on('selection:cleared', function() {
        $('#Text').hide();
        $('#Image').hide();
        $('#Shape').hide();
        $('#Background').fadeIn("slow");
    });
    canvas.on('object:selected', function(e) {
        var activeObject = e.target;
        if (activeObject.class == "text") {
            $("#colorpicker-text").val(activeObject.fill);
            $("#colorpicker-text").css('backgroundColor', activeObject.fill);
            $('#textarea-text').val(activeObject.text);
            $("#fontfamily-text").val(activeObject.fontFamily);
            //$("#txtfont").css('setBackgroundColor', activeObject.fontFamily);
            $("#fontsize-text").val(activeObject.fontSize);
            //$("#fontsize").css('setBackgroundColor', activeObject.fontsize);
            $("#slider-text").val(activeObject.opacity * 100);
            console.log(activeObject.lockMovementX);
            if (activeObject.lockMovementX == true) {
                $("#lock-text").addClass('btn-primary');
                $("#unlock-text").removeClass('btn-primary');
            } else {
                $("#lock-text").removeClass('btn-primary');
                $("#unlock-text").addClass('btn-primary');
            }
            $('#Shape').hide();
            $('#Image').hide();
            $('#Background').hide();
            $('#Text').fadeIn("slow");
        } else if (activeObject.class == "image") {
            $('#Shape').hide();
            $('#Background').hide();
            $('#Text').hide();
            $('#Image').fadeIn("slow");
            $("#test5c").val(activeObject.opacity * 100);
            $("#slider-image").val(activeObject.opacity * 100);
            if (activeObject.lockMovementX == true) {
                $("#lock-image").addClass('btn-primary');
                $("#unlock-image").removeClass('btn-primary');
            } else {
                $("#lock-image").removeClass('btn-primary');
                $("#unlock-image").addClass('btn-primary');
            }
        } else if (activeObject.class == "svg") {
            $('#Background').hide();
            $('#Text').hide();
            $('#Image').hide();
            $('#Shape').fadeIn("slow");
            $("#slider-shape").val(activeObject.opacity * 100);
            if (activeObject.lockMovementX == true) {
                $("#lock-shape").addClass('btn-primary');
                $("#unlock-shape").removeClass('btn-primary');
            } else {
                $("#lock-shape").removeClass('btn-primary');
                $("#unlock-shape").addClass('btn-primary');
            }
        }
    });
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
        //******Text Code**********//
    this.addText = function(_text, options, id) {
        //var self = this;
        var text = new fabric.Text(_text || 'Enter Your Text Here', {
            left: (options && options.left) || canvas.getWidth() / 2,
            top: (options && options.top) || canvas.getHeight() / 4,
            width: (options && options.width) || 200,
            height: (options && options.height) || 200,
            textAlign: 'center',
            class: 'text',
            fill: 'black',
            fontSize: 48,
            fontFamily: 'Times New Romans',
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
        canvas.renderAll();
    }
    this.modifyText = function(_text) {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                text: _text
            });
            canvas.renderAll();
        }
    };
    this.fontchange = function(font) {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                fontFamily: font
            });
        }
        canvas.renderAll();
    };
    this.fontSize = function(size) {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                fontSize: size
            });
        }
        canvas.renderAll();
    };
    this.FontBold = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            if (obj.fontWeight == 'bold') {
                obj.set({
                    fontWeight: 'normal'
                });
            } else {
                obj.set({
                    fontWeight: 'bold'
                });
            }
        }
        canvas.renderAll();
    };
    this.FontUnderline = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            if (obj.textDecoration == 'underline') {
                obj.set({
                    textDecoration: 'normal'
                });
            } else {
                obj.set({
                    textDecoration: 'underline'
                });
            }
        }
        canvas.renderAll();
    };
    this.Fontitalic = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            if (obj.fontStyle == 'italic') {
                obj.set({
                    fontStyle: 'normal'
                });
            } else {
                obj.set({
                    fontStyle: 'italic',
                    fontFamily: 'Delicious'
                });
            }
        }
        canvas.renderAll();
    };
    this.FontAlignRight = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                textAlign: 'right'
            });
        }
        canvas.renderAll();
    };
    this.FontAlignleft = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                textAlign: 'left'
            });
        }
        canvas.renderAll();
    };
    this.FontAlignCenter = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                textAlign: 'center'
            });
        }
        canvas.renderAll();
    };
    this.FontAlignjustify = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                textAlign: 'justify'
            });
        }
        canvas.renderAll();
    };
    this.textopacity = function(opacity) {
        var obj = canvas.getActiveObject();
        if (obj && obj.class == "text" || obj && obj.class == "image") {
            obj.setOpacity(opacity / 100);
        } else {
            obj = canvas.getActiveGroup();
            if (obj) {
                for (var i = 0; i < obj._objects.length; i++) {
                    obj._objects[i].opacity = opacity / 100;
                }
            }
        }
        canvas.renderAll();
    };
    this.bringForward = function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        canvas.bringForward(obj);
        canvas.renderAll();
    };
    this.bringBack = function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        canvas.sendBackwards(obj);
        canvas.renderAll();
    };
    this.textopacity = function(opacity) {
        var obj = canvas.getActiveObject();
        if (obj && obj.class == "text" || obj && obj.class == "image") {
            obj.setOpacity(opacity / 100);
        } else {
            obj = canvas.getActiveGroup();
            if (obj) {
                for (var i = 0; i < obj._objects.length; i++) {
                    obj._objects[i].opacity = opacity / 100;
                }
            }
        }
        canvas.renderAll();
    };
    this.setbgcol = function(hex) {
        color = hex;
        canvas.setBackgroundColor(color);
        canvas.renderAll();
    };
    this.settextcol = function(hex) {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                fill: hex
            });
        }
        canvas.renderAll();
    };
    this.lock = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                lockMovementX: true,
                lockMovementY: true,
                lockRotation: true,
                lockScalingX: true,
                lockScalingY: true
            });
        }
        canvas.renderAll();
    };
    this.unlock = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            obj.set({
                lockMovementX: false,
                lockMovementY: false,
                lockRotation: false,
                lockScalingX: false,
                lockScalingY: false
            });
        };
        canvas.renderAll();
    }
    this.removetext = function() {
        var obj = canvas.getActiveObject();
        canvas.fxRemove(obj);
        canvas.renderAll();
    };
     this.textopacity = function(opacity) {
        var obj = canvas.getActiveObject();
        if (obj && obj.class == "text" || obj && obj.class == "image") {
            obj.setOpacity(opacity / 100);
        } else {
            obj = canvas.getActiveGroup();
            if (obj) {
                for (var i = 0; i < obj._objects.length; i++) {
                    obj._objects[i].opacity = opacity / 100;
                }
            }
        }
        canvas.renderAll();
    };
    this.addsvg = function(site_url) {
        var site_url = 'http://fabricjs.com/assets/1.svg';
        fabric.loadSVGFromURL(site_url, function(objects) {
            var group = new fabric.PathGroup(objects, {
                left: 65,
                top: 0,
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
        //******Image Code**********//
    this.addImage = function(source) {
        var Left = canvas.width / 2;
        var Top = canvas.height / 2;
        fabric.Image.fromURL(source, function(img) {
            img.class = 'image';
            img.source = source;
            img.id = "test";
            img.originX = "center";
            img.originY = "center";
            img.top = 290;
            img.left = 180;
            img.width = 150;
            img.height = 180;
            canvas.add(img);
            canvas.renderAll();
        });
    }
    this.lockimg = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "image") {
            obj.set({
                lockMovementX: true,
                lockMovementY: true,
                lockRotation: true,
                lockScalingX: true,
                lockScalingY: true
            });
        }
        canvas.renderAll();
    };
    this.unlockimg = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "image") {
            obj.set({
                lockMovementX: false,
                lockMovementY: false,
                lockRotation: false,
                lockScalingX: false,
                lockScalingY: false
            });
        }
        canvas.renderAll();
    };
    this.imgRotationRight = function(_angle) {
        var obj = canvas.getActiveObject();
        if (obj.class == "image") {
            obj.set({
                angle: obj.angle + _angle
            });
        }
        canvas.renderAll();
    };
    this.imgRotationLeft = function(_angle) {
        var obj = canvas.getActiveObject();
        if (obj.class == "image") {
            obj.set({
                angle: obj.angle - _angle
            });
        }
        canvas.renderAll();
    };
    this.bringForwardimage= function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        canvas.bringForward(obj);
        canvas.renderAll();
    };
    this.bringBackimage= function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        canvas.sendBackwards(obj);
        canvas.renderAll();
    };
    this.imgopacity = function(opacity) {
        var obj = canvas.getActiveObject();
        obj.setOpacity(opacity / 100);
        canvas.renderAll();
    };
    //******SVG Code**********//
    this.addsvg = function(src) {
        fabric.loadSVGFromURL(src, function(objects, options) {
            var obj = fabric.util.groupSVGElements(objects, options);
            obj.set({
                class: "svg",
                scaleX: 0.4,
                scaleY: 0.4,
                left: 0,
                top: 0
            });
            canvas.add(obj).renderAll();
        });
    }
    this.svgopacity = function(opacity) {
        var obj = canvas.getActiveObject();
        obj.setOpacity(opacity / 100);
        canvas.renderAll();
    };
    this.setsvgcol = function(hex) {
        var obj = canvas.getActiveObject();
        if (obj.class == "svg") {
            obj.set({
                fill: hex
            });
        }
        canvas.renderAll();
    };
    this.locksvg = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "svg") {
            obj.set({
                lockMovementX: true,
                lockMovementY: true,
                lockRotation: true,
                lockScalingX: true,
                lockScalingY: true
            });
        }
        canvas.renderAll();
    };
    this.unlocksvg = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "svg") {
            obj.set({
                lockMovementX: false,
                lockMovementY: false,
                lockRotation: false,
                lockScalingX: false,
                lockScalingY: false
            });
        }
        canvas.renderAll();
    };
    this.svgRotationRight = function(_angle) {
        var obj = canvas.getActiveObject();
        if (obj.class == "svg") {
            obj.set({
                angle: obj.angle + _angle
            });
        }
        canvas.renderAll();
    };
    this.svgRotationLeft = function(_angle) {
        var obj = canvas.getActiveObject();
        if (obj.class == "svg") {
            obj.set({
                angle: obj.angle - _angle
            });
        }
        canvas.renderAll();
    };
    this.bringForwardsvg = function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        canvas.bringForward(obj);
        canvas.renderAll();
    };
    this.bringBacksvg = function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        canvas.sendBackwards(obj);
        canvas.renderAll();
    };
    this.svgopacity = function(opacity) {
        var obj = canvas.getActiveObject();
        if (obj.class == "svg") {
            obj.setOpacity(opacity / 100);
            canvas.renderAll();
        }
    };
     this.applypattern = function(url) {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            this.loadPattern_text(url);
        } else if (obj.class == "svg") {
            this.loadPattern_svg(url);
        } else if (obj.class == "img") {
            this.loadPattern_text(url);
        }
    }
    this.loadPattern_text = function(url) {
        var curSelectedObjects = canvas.getObjects();
        canvas.discardActiveGroup();
        fabric.util.loadImage(url, function(img) {
            for (var i = 0; i < curSelectedObjects.length; i++) {
                var obj = curSelectedObjects[i];
                if (obj.class == "text") {
                    obj.fill = new fabric.Pattern({
                        source: img
                    });
                    canvas.renderAll();
                }
            }
        });
    }
     this.removepattern_svg = function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        if (obj instanceof fabric.PathGroup) {
            obj.getObjects().forEach(function(o) {
                o.fill = "#000000";
            });
        }
        canvas.renderAll();
    };
    this.removepattern_text = function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        obj.fill = "#eeeeee";
        canvas.renderAll();
    };
    this.removepattern = function() {
        var obj = canvas.getActiveObject();
        if (obj.class == "text") {
            this.removepattern_text();
        } else if (obj.class == "svg") {
            this.removepattern_svg();
        } else if (obj.class == "img") {
            this.removepattern_text();
        }
    }
    this.loadPattern_svg = function(src) {
        fabric.Image.fromURL(src, function(img) {
            var patternSourceCanvas = new fabric.StaticCanvas();
            patternSourceCanvas.add(img);
            var pattern = new fabric.Pattern({
                source: function() {
                    patternSourceCanvas.setDimensions({
                        width: img.getWidth(),
                        height: img.getHeight()
                    });
                    return patternSourceCanvas.getElement();
                },
                repeat: 'repeat'
            });
            var obj = canvas.getActiveObject();
            if (!obj) return;
            if (obj.class == 'svg') {
                if (obj instanceof fabric.PathGroup) {
                    obj.getObjects().forEach(function(o) {
                        o.fill = pattern;
                    });
                } else if (obj.class == 'text') {}
            }
            canvas.renderAll();
            document.getElementById('myRange').onchange = function() {
                img.scaleToWidth(parseInt(this.value, 10));
                canvas.renderAll();
            };
            document.getElementById('img-angle').onchange = function() {
                img.setAngle(this.value);
                canvas.renderAll();
            };
            document.getElementById('img-offset-x').onchange = function() {
                pattern.offsetX = parseInt(this.value, 10);
                canvas.renderAll();
            };
            document.getElementById('img-offset-y').onchange = function() {
                pattern.offsetY = parseInt(this.value, 10);
                canvas.renderAll();
            };
            document.getElementById('img-repeat').onclick = function() {
                pattern.repeat = this.checked ? 'repeat' : 'no-repeat';
                canvas.renderAll();
            };
        })
    };
   
}