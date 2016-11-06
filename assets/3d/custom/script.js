		var canvas = new fabric.Canvas("fabric");
		current_obj = null;
		$(document).data('uploaded', false);

		
		
		

/*		canvas.loadFromJSON(JSON.stringify(jsn1), canvas.renderAll.bind(canvas), function(o, object) {
           fabric.log(o);
           console.log("HERE", object);
       });
*/		

		fabric.loadSVGFromURL('../public/uploads/product_categories/'+productss+'/'+base_svg+'.svg', function(objects, options) {
			var obj = fabric.util.groupSVGElements(objects, options);
			obj.set({
				top: 0,
				left: 0,
				scaleY: canvas.height / obj.height,
				scaleX: canvas.width / obj.width
			});
			canvas.add(obj).renderAll();
			console.log("Base svg loaded");	
			$(document).data('uploaded', true);


			if($(document).data('uploaded')){

				fabric.loadSVGFromURL('../public/uploads/product_categories/'+productss+'/'+middle_svg+'.svg', function(objects, options) {
					var obj = fabric.util.groupSVGElements(objects, options);
					obj.set({
						top: 0,
						left: 0,
						scaleY: canvas.height / obj.height,
						scaleX: canvas.width / obj.width
					});

					canvas.add(obj).renderAll();
					console.log("Design svg loaded");

					if(top_svg!=null)
					{
						if($(document).data('uploaded')){

							fabric.loadSVGFromURL('../public/uploads/product_categories/'+productss+'/'+top_svg+'.svg', function(objects, options) {
								var obj = fabric.util.groupSVGElements(objects, options);
								obj.set({
									top: 0,
									left: 0,
									scaleY: canvas.height / obj.height,
									scaleX: canvas.width / obj.width
								});
								canvas.add(obj).renderAll();
								changeSVGColor1();
								console.log("Logo svg loaded");
							});
						}
					}

				});
			}
			
		});


		

		var changeSVGColor1 = function(){
			var obj = canvas.getObjects();
			obj[0].setFill($('#color_svg_1').val());
			obj[1].setFill($('#color_svg_2').val());
			obj[2].setFill($('#color_svg_3').val());
			canvas.renderAll();
		};

		var changeSVGColor2 = function(){
			var obj = canvas.getObjects();
			obj[0].setFill($('#color_svg_1').val());
			obj[1].setFill($('#color_svg_2').val());
			obj[2].setFill($('#color_svg_3').val());

			canvas.renderAll();
		};

		var changeSVGColor3 = function(){
			var obj = canvas.getObjects();
			obj[0].setFill($('#color_svg_1').val());
			obj[1].setFill($('#color_svg_2').val());
			obj[2].setFill($('#color_svg_3').val());

			canvas.renderAll();
		};

		$(document).ready(function(){
			$('#add_svg_1').click(function(){
				console.log("loaded");
				
			});

			$('#add_svg_2').click(function(){


			});

			// $('#export_JPEG_image').on('click', function(event){
				// $(document).on('change', '#color_svg_1, #color_svg_2, #color_svg_3, .more_settings input', function(event) {
					$(document).on('change', '#color_svg_1, #color_svg_2, #color_svg_3', function(event) {
					render3d();
				});

				$(document).on('click', '.pattern_click, #removepattern', function(event) {
					event.preventDefault();
					// setTimeout(function() {
					// 		// render3d();
					// }, 2000);
				

			});

				var render3d = function(){
					if($('#color_svg_1, #color_svg_2').val()!='')
					{
						var pngImage = canvas.toDataURLWithMultiplier('jpg', 2);
						var jsn = canvas.toJSON();
						$('#json').text(pngImage);
				// return false;
				/*var win = window.open(pngImage, '_blank');
				win.focus();*/

				$.ajax({
					url: site_url+'design/save_image',
					type: 'POST',
					/*dataType: "json",*/
					data: {json: $('#json').text(), file: generate_file_name, product: productss, jsn: jsn},
					async: false,
					success: function(res)
					{
						

						
						// console.log(res); return false;
						if(res == 'done') 
						{
							console.log('done');
							$('.loading').hide();
							// $('#json').html('<a href="shorts.jpg">Open new file</a>');
							// event.preventDefault();

							$('#tjs').remove();
							$('.tjs_canvas').prepend('<canvas id="tjs" style="width: 100%; height:500px"></canvas>');
							$('#loading').show();
							// init('shorts2.mtl', 'shorts2.obj');
							// animate();
							location.reload();
						}
						else {console.log('error: '+res);}
					},
					error: function(res){
						console.log(res); return false;
						console.log('error: '+res);
					},
					beforeSend: function(){
						if (typeof(Storage) !== "undefined") 
						{
							sessionStorage.setItem('base', $('#color_svg_1').val());
							sessionStorage.setItem('middle', $('#color_svg_2').val());
							sessionStorage.setItem('top', $('#color_svg_3').val());
						}
						else alert('Local Storage Not Found. Please use chrome or firefox for best experience.');
						$('.loading').fadeIn();
					}
				});
	}
	else {
		noti('warning','Please select a colors for the product');
	}
}

$('#clear').on('click', function(event) {
	event.preventDefault();
	$('input').val('');
});
});

		var applypattern = function(url) {
			var obj = canvas.item(current_obj);
        // obj = obj[2];
        // console.log('class: '+obj.class);
        // if (obj.class == "text") {
            // loadPattern_text(url);
        // } else if (obj.class == "svg") {
        	loadPattern_svg(url);
        // } else if (obj.class == "img") {
            // loadPattern_text(url);
        // }
    }

    var loadPattern_text = function(url) {
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

    var loadPattern_svg = function(src) {
	// console.log(src);
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
			var obj = canvas.item(current_obj);
                // console.log(obj.class);
                if (!obj) return;
                // if (obj.class == 'svg') {
                	if (obj instanceof fabric.PathGroup) {
                		obj.getObjects().forEach(function(o) {
                			o.fill = pattern;
                		});
                	} else if (obj.class == 'text') {}
                // }
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

var removepattern_svg = function() {
	var obj = canvas.getActiveObject();
	if (!obj) return;
	if (obj instanceof fabric.PathGroup) {
		obj.getObjects().forEach(function(o) {
			o.fill = "#000000";
		});
	}
	canvas.renderAll();
};
var removepattern_text = function() {
	var obj = canvas.getActiveObject();
	if (!obj) return;
	obj.fill = "#eeeeee";
	canvas.renderAll();
};
var removepattern = function() {
	var obj = canvas.getActiveObject();
	if (obj.class == "text") {
		this.removepattern_text();
	} else if (obj.class == "svg") {
		this.removepattern_svg();
	} else if (obj.class == "img") {
		this.removepattern_text();
	}
}

var readURL_pattern = function(input) {
	for (var i = 0; i < input.files.length; i++) {
		if (input.files && input.files[i]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				applypattern(e.target.result);
				setTimeout(function() {
					$(".file-upload").val('');
				}, 1000);
			}
			reader.readAsDataURL(input.files[i]);
		}
	}
}

var update_current_obj = function(obj)
{
	current_obj = obj;
	console.log(current_obj);
	$('.more_settings').hide();
	$('.more_settings').show();
}

$('.settings_close').on('click', function(event) {
	event.preventDefault();
	$('.more_settings').hide();
});

$("body").delegate(".pattern_click", "click", function() {
        // console.log('pattern clicked');
        applypattern($(this).attr('src'));
    });
$("#imgrotationright").click(function() {
	imgRotationRight(90);
});
$("#imgrotationleft").click(function() {
	imgRotationLeft(90);
});
$('#removepattern').on('click', function(event) {
	event.preventDefault();
	removepattern();
});
$('#browse-pattern').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$("#hidden-input-pattern").trigger('click');
});
$("#hidden-input-pattern").on('change', function() {
	readURL_pattern(this);
	$("#hidden-input-pattern").val("");
});

// $(document).ready(function($) {
			// changeSVGColor1();
		// });

/*
fabric.util.addListener(document.getElementById('data-url'), 'click', function () {
	var value = document.getElementById('data-url-val').value;
	console.log(value);
    var dataURL = canvas.toDataURLWithMultiplier("jpeg", value);
    window.open(dataURL);
});*/