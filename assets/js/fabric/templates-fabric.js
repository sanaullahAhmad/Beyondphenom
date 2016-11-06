prototypefabric;
var r = 0;
var color = "gray";
var front = "";
var back = "";
var pattren="";
var front_count = 0;
var back_count = 0;
var Pattren_count=0;
var current = "back";
fabric.Object.prototype.toObject = (function(toObject) {
    return function() {
        return fabric.util.object.extend(toObject.call(this), {
            class: this.class
        });
    };
})(fabric.Object.prototype.toObject);
var prototypefabric = new function() {
    var canvas = new fabric.Canvas('mycanvas', {
        width: 510,
        height: 575,
        backgroundColor: 'white'
    });
    canvas.clipBackground = false;
    canvas.clipOverlay = false;
    canvas.controlsAboveOverlay = true;
    fabric.Object.prototype.transparentCorners = false;
    canvas.renderAll();
    this.createOverlay_front = function(_src) {
        if (current == "back") {
            back = JSON.stringify(canvas);
            //if (front_count > 1) {}
            canvas.forEachObject(function(obj) {
                canvas.fxRemove(obj);
            });
            canvas.renderAll();
            if (front_count == 0) {
                var testimage = new Image();
                testimage.onload = function() {
                    shirtimage = new fabric.Image(testimage, {
                        originX: 'left',
                        originY: 'top',
                        src: _src,
                        width: 100,
                        height: 120,
                        scaleX: 0.2,
                        scaleY: 0.2,
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
            }
            canvas.setBackgroundColor(color);
            front_count++;
            current = "front";
            canvas.renderAll();
        }
        else if (current == "pattren") {
            pattren = JSON.stringify(canvas);
            //if (back_count > 0) {}
            canvas.forEachObject(function(obj) {
                console.log(obj);
                canvas.fxRemove(obj);
            });
            canvas.renderAll();
            if (front_count == 0) {
                var testimage = new Image();
                testimage.onload = function() {
                    shirtimage = new fabric.Image(testimage, {
                        originX: 'left',
                        originY: 'top',
                        src: _src,
                        width: 100,
                        height: 120,
                        scaleX: 0.2,
                        scaleY: 0.2,
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
            }
            back = JSON.stringify(canvas);
            back_count++;
            current = "front";
            canvas.setBackgroundColor(color);
            canvas.renderAll();
        }
    }
    this.createOverlay_back = function(_src) {
        if (current == "front") {
            front = JSON.stringify(canvas);
            //if (back_count > 0) {}
            canvas.forEachObject(function(obj) {

                canvas.fxRemove(obj);
            });
            canvas.renderAll();
            if (back_count == 0) {
                var testimage = new Image();
                testimage.onload = function() {
                    shirtimage = new fabric.Image(testimage, {
                        originX: 'left',
                        originY: 'top',
                        src: _src,
                        width: 100,
                        height: 120,
                        scaleX: 0.2,
                        scaleY: 0.2,
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
            if (back_count > 0) {
                this.load(back);
            }
            back = JSON.stringify(canvas);
            back_count++;
            current = "back";
            canvas.setBackgroundColor(color);
            canvas.renderAll();
        }
        else if (current == "pattren") {
            pattren = JSON.stringify(canvas);
            //if (back_count > 0) {}
            canvas.forEachObject(function(obj) {
                console.log(obj);
                canvas.fxRemove(obj);
            });
            canvas.renderAll();
            if (back_count == 0) {
                var testimage = new Image();
                testimage.onload = function() {
                    shirtimage = new fabric.Image(testimage, {
                        originX: 'left',
                        originY: 'top',
                        src: _src,
                        width: 100,
                        height: 120,
                        scaleX: 0.2,
                        scaleY: 0.2,
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
            if (back_count > 0) {
                this.load(back);
            }
            back = JSON.stringify(canvas);
            back_count++;
            current = "back";
            canvas.setBackgroundColor(color);
            canvas.renderAll();
        }
    };
    this.createOverlay_pattren = function(_src) {
        if (current == "front") {
            front = JSON.stringify(canvas);
            //if (front_count > 1) {}
            canvas.forEachObject(function(obj) {
                canvas.fxRemove(obj);
            });
            canvas.renderAll();
            if ( Pattren_count == 0) {
                var testimage = new Image();
                testimage.onload = function() {
                    shirtimage = new fabric.Image(testimage, {
                        originX: 'left',
                        originY: 'top',
                        src: _src,
                        width: 100,
                        height: 120,
                        scaleX: 0.2,
                        scaleY: 0.2,
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
            if (Pattren_count > 0) {
                this.load(pattren);
            }
            canvas.setBackgroundColor(color);
            Pattren_count++;
            current = "pattren";
            canvas.renderAll();
        }
        else if (current == "back") {
            back = JSON.stringify(canvas);
            //if (back_count > 0) {}
            canvas.forEachObject(function(obj) {
                canvas.fxRemove(obj);
            });
            canvas.renderAll();
            if (pattren_count == 0) {
                var testimage = new Image();
                testimage.onload = function() {
                    shirtimage = new fabric.Image(testimage, {
                        originX: 'left',
                        originY: 'top',
                        src: _src,
                        width: 100,
                        height: 120,
                        scaleX: 0.2,
                        scaleY: 0.2,
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
            if (Pattren_count > 0) {
                this.load(pattren);
            }
            back = JSON.stringify(canvas);
            back_count++;
            current = "pattren";
            canvas.setBackgroundColor(color);
            canvas.renderAll();
        }
    }
    this.load = function(obj) {
        if (obj == null) {
            return;
        }
        canvas.loadFromJSON(obj, canvas.renderAll.bind(canvas), function(o, object) {
            console.log(object);
        });
    }
    this.setCanvasSize = function(src) {
        var testimage = new Image();
        testimage.onload = function() {
            canvas.setHeight(testimage.height);
            canvas.setWidth(testimage.width);
            canvas.renderAll();
        };
        testimage.src = src;
        canvas.renderAll();
    };
    canvas.on('object:selected', function(o) {
        var object = o.target;
        // console.log(object.fill);
        // $(".sp-preview-inner").css('backgroundColor', object.fill);
        // $("#ColorVal").val(object.fill);
        // $(".sp-preview-inner").css('backgroundColor', object.fill);
        if (object.class == "text") {
            $("#colorpicker7").val(object.fill);
            $("#colorpicker7").css('backgroundColor', object.fill);
            $('#textarea1').val(object.text);
            $("#txtfont").val(object.fontFamily);
            $("#txtfont").css('setBackgroundColor', object.fontFamily);
            $("#fontsize").val(object.fontSize);
            $("#fontsize").css('setBackgroundColor', object.fontsize);
            $("#test5b").val(object.opacity * 100);
            if (object.lockMovementX == true) {
                $("#lock").addClass('btn-primary');
                $("#unlock").removeClass('btn-primary');
            } else {
                $("#lock").removeClass('btn-primary');
                $("#unlock").addClass('btn-primary');
            }
        }
        if (object.class == "svg") {
            $("#colorpicker8").val(object.fill);
            $("#colorpicker8").css('backgroundColor', object.fill);
            $("#test5c").val(object.opacity * 100);
            $("#test5d").val(object.opacity * 100);
            if (object.lockMovementX == true) {
                $("#locksvg").addClass('btn-primary');
                $("#unlocksvg").removeClass('btn-primary');
            } else {
                $("#locksvg").removeClass('btn-primary');
                $("#unlocksvg").addClass('btn-primary');
            }
        }
        if (object.class == "image") {
            $("#test5c").val(object.opacity * 100);
            $("#test5d").val(object.opacity * 100);
            if (object.lockMovementX == true) {
                $("#lockimg").addClass('btn-primary');
                $("#unlockimg").removeClass('btn-primary');
            } else {
                $("#lockimg").removeClass('btn-primary');
                $("#unlockimg").addClass('btn-primary');
            }
        }
    });
    this.addText = function(_text, options, id) {
        var text = new fabric.Text(_text || 'Enter Your Text Here', {
            left: (options && options.left) || canvas.getWidth() / 3,
            top: (options && options.top) || canvas.getHeight() / 4,
            width: (options && options.width) || 200,
            height: (options && options.height) || 200,
            textAlign: 'center',
            class: 'text',
            type: 'text',
            fill: 'White',
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
        text.set({
            class: "text"
        });
        canvas.add(text);
        canvas.setActiveObject(text);
        canvas.renderAll();
    };
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
            canvas.add(img);
            img.set({
                class: "image"
            });
            canvas.deactivateAll().renderAll()
            canvas.setActiveObject(img);
            canvas.renderAll();
        });
    };
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
    this.bringForwardimg = function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        canvas.bringForward(obj);
        canvas.renderAll();
    };
    this.bringBackimg = function() {
        var obj = canvas.getActiveObject();
        if (!obj) return;
        canvas.sendBackwards(obj);
        canvas.renderAll();
    };
    this.svgopacity = function(opacity) {
        var obj = canvas.getActiveObject();
        obj.setOpacity(opacity / 100);
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
    this.removetext = function() {
        var obj = canvas.getActiveObject();
        canvas.fxRemove(obj);
        canvas.renderAll();
    };
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
    this.setsvgcol = function(hex) {
        var obj = canvas.getActiveObject();
        if (obj.class == "svg") {
            obj.set({
                fill: hex
            });
        }
        canvas.renderAll();
    };
    this.getjson = function() {
        var json = JSON.stringify(canvas.toJSON(['class']));
        return json;
    }
    this.addsvg = function(src) {
        fabric.loadSVGFromURL(src, function(objects, options) {
            var obj = fabric.util.groupSVGElements(objects, options);
            obj.set({
                class: "svg",
                scaleX: 0.4,
                scaleY: 0.4,
                left: 175,
                top: 100
            });
            canvas.add(obj).renderAll();
        });
    }
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
    this.loadPattern_svg = function(src) {
        if(src != ""){
            fabric.Image.fromURL(src, function(img) {
                var pattern = new fabric.Pattern({
                    source: function() {
                        if(typeof img != "undefined"){
                            var patternSourceCanvas = new fabric.StaticCanvas();
                            patternSourceCanvas.add(img);
                            if(patternSourceCanvas){
                                patternSourceCanvas.setDimensions({
                                    width: img.getWidth(),
                                    height: img.getHeight()
                                });
                                return patternSourceCanvas.getElement();
                            }
                        }
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
        }
    };
    this.ExportLayer = function(width, height, ExportWidth, ExportHeight) {
        var json = JSON.stringify(canvas.toJSON(['class']));
        return json;
    }
    this.ExportImage = function(width, height, ExportWidth, ExportHeight) {
        canvas.renderAll();
        sObj = JSON.stringify(canvas.toJSON(['class']));
        var _base64 = canvas.toDataURL();
        return _base64;
    }
}