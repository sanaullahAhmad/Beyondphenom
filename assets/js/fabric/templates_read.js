$(document).ready(function() {
    var col7 = rgb_Con($("#colorpicker7").css('background-color'));
    var _GoogleFontApiLink = "";
    var _Fonts = "http://fonts.googleapis.com/css?family=Open";
    var _FontArray = ['Open Sans', 'Roboto', 'Lato', 'Oswald', 'Lora', 'Source Sans Pro', 'Montserrat', 'Raleway', 'Ubuntu', 'Droid Serif', 'Merriweather', 'Indie Flower', 'Titillium Web', 'Poiret One', 'Oxygen', 'Yanone Kaffeesatz', 'Lobster', 'Playfair Display', 'Fjalla One', 'Inconsolata'];
    for (var i = 0; i < _FontArray.length; i++) {
        $('#txtfont').append($('<option>', {
            value: _FontArray[i],
            text: _FontArray[i]
        }));
    }
    var div = document.getElementById("dom-target");
    var url = div.textContent;
    prototypefabric.createOverlay_front(url);

    var shirt_src = 'front.png';
    //var shirt_src = 'back.png';
    //var shirt_src = 'back.png';
    //var shirt_src = 'back.png';
    //prototypefabric.setCanvasSize(shirt_src);
    prototypefabric.createOverlay_front(url);
    $("#front_shirt").click(function() {
        prototypefabric.createOverlay_front(url);
    });
    $("#back_shirt").click(function() {
        prototypefabric.createOverlay_back(url);
    });
    $("#Pattren_file").click(function() {
        prototypefabric.createOverlay_pattren(url);
    });
    // prototypefabric.load(front);
    $('#browse-img').click(function() {
        $("#hidden-input-img").trigger('click');
    });
    $("#hidden-input-img").on('change', function() {
        readURL_img(this);
        $("#hidden-input-img").val("");
    });
    var readURL_img = function(input) {
        for (var i = 0; i < input.files.length; i++) {
            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    prototypefabric.addImage(e.target.result);
                    setTimeout(function() {}, 1000);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
    var readURL_svg = function(input) {
        for (var i = 0; i < input.files.length; i++) {
            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    prototypefabric.addsvg(e.target.result);
                    setTimeout(function() {}, 1000);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
    $('#browse-svg').click(function() {
        $("#hidden-input-svg").trigger('click');
    });
    $("#hidden-input-svg").on('change', function() {
        readURL_svg(this);
        $("#hidden-input-svg").val("");
    });
    var readURL_pattern = function(input) {
        for (var i = 0; i < input.files.length; i++) {
            if (input.files && input.files[i]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    prototypefabric.applypattern(e.target.result);
                    setTimeout(function() {
                        $(".file-upload").val('');
                    }, 1000);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
    $('#browse-pattern').click(function() {
        $("#hidden-input-pattern").trigger('click');
    });
    $("#hidden-input-pattern").on('change', function() {
        readURL_pattern(this);
        $("#hidden-input-pattern").val("");
    });
    $("body").delegate(".pattern_click", "click", function() {
        prototypefabric.applypattern($(this).attr('src'));
    });
    $("#imgrotationright").click(function() {
        prototypefabric.imgRotationRight(90);
    });
    $("#imgrotationleft").click(function() {
        prototypefabric.imgRotationLeft(90);
    });
    $("#test5c").change(function() {
        var opacity = $("#test5c").val();
        prototypefabric.svgopacity(opacity);
    });
    $('#removesvg').click(function() {
        prototypefabric.removetext();
    });
    $('#removepattern').click(function() {
        prototypefabric.removepattern();
    });
    $('#textarea1').val('New Text');
    $('#textarea1').trigger('autoresize');
    $('#addtext').click(function() {
        prototypefabric.addText($('#textarea1').val());
    });
    $('#textarea1').keyup(function() {
        prototypefabric.modifyText($('#textarea1').val());
    });
    $('#removetext').click(function() {
        prototypefabric.removetext();
    });
    $("#txtfont").change(function() {
        prototypefabric.fontchange($("#txtfont").val());
    });
    $("#fontsize").change(function() {
        prototypefabric.fontSize($("#fontsize").val());
    });
    $("#bold").click(function() {
        prototypefabric.FontBold();
    });
    $("#underline").click(function() {
        prototypefabric.FontUnderline();
    });
    $("#italic").click(function() {
        prototypefabric.Fontitalic();
    });
    $("#alignright").click(function() {
        prototypefabric.FontAlignRight();
    });
    $("#alignleft").click(function() {
        prototypefabric.FontAlignleft();
    });
    $("#aligncenter").click(function() {
        prototypefabric.FontAlignCenter();
    });
    $("#justify").click(function() {
        prototypefabric.FontAlignjustify();
    });
    $("#editor-bringFront").click(function() {
        prototypefabric.bringForward();
    });
    $("#editor-sendBack").click(function() {
        prototypefabric.bringBack();
    });
    $("#lock").click(function() {
        $("#lock").addClass('btn-primary');
        $("#unlock").removeClass('btn-primary');
        prototypefabric.lock();
    });
    $("#unlock").click(function() {
        $("#lock").removeClass('btn-primary');
        $("#unlock").addClass('btn-primary');
        prototypefabric.unlock();
    });
    $("#editor-bringFrontimg").click(function() {
        prototypefabric.bringForwardimg();
    });
    $("#editor-sendBackimg").click(function() {
        prototypefabric.bringBackimg();
    });
    $("#lockimg").click(function() {
        prototypefabric.lockimg();
    });
    $("#unlockimg").click(function() {
        prototypefabric.unlockimg();
    });
    $("#locksvg").click(function() {
        $("#locksvg").addClass('btn-primary');
        $("#unlocksvg").removeClass('btn-primary');
        prototypefabric.locksvg();
    });
    $("#unlocksvg").click(function() {
        $("#unlocksvg").addClass('btn-primary');
        $("#locksvg").removeClass('btn-primary');
        prototypefabric.unlocksvg();
    });
    $("#editor-bringFrontsvg").click(function() {
        prototypefabric.bringForwardsvg();
    });
    $("#editor-sendBacksvg").click(function() {
        prototypefabric.bringBacksvg();
    });
    $("#test5d").change(function() {
        var opacity = $("#test5d").val();
        prototypefabric.textopacity(opacity);
    });
    $("#test5b").change(function() {
        var opacity = $("#test5b").val();
        prototypefabric.textopacity(opacity);
    });
    $('#shirt_color').change(function() {
        var col = $(this).val()
        prototypefabric.setbgcol(col);
    });
    $("#svgrotationright").click(function() {
        prototypefabric.svgRotationRight(90);
    });
    $("#svgrotationleft").click(function() {
        prototypefabric.svgRotationLeft(90);
    });
    $('#removesvg1').click(function() {
        prototypefabric.removetext();
    });
    $("#Exportbtn").click(function() {
        var ExportHeight = document.getElementById("NewHeightEx").value;
        var ExportWidth = document.getElementById("NewWidthEx").value;
        var Width = parseInt($("#width").val());
        var Height = parseInt($("#height").val());
        prototypefabric.ExportImage(Width, Height, ExportWidth, ExportHeight);
    });
    $('#form_submit').on('click', function(event) {
        event.preventDefault();
        $('#json_div').text(prototypefabric.getjson());
        $('#image_div').text(prototypefabric.ExportImage('500', '600', '500', '600'));
        $('#image_layer_div').text(prototypefabric.ExportLayer('500', '600', '500', '600'));
        $('#json_div_back').text(prototypefabric.getjson());
        $('#image_div_back').text(prototypefabric.ExportImage('500', '600', '500', '600'));
        $('#image_layer_div_back').text(prototypefabric.ExportLayer('500', '600', '500', '600'));

        $.ajax({
            url: site_url + '/templates/base64_to_img/',
            type: 'POST',
            data: {
                json: $('#json_div').text(),
                image: $('#image_div').text(),
                image_layer: $('#image_layer_div').text()
            },
            beforeSend: function() {
                $(this).button('loading');
                bootbox.dialog({
                    message: "<div style='text-align: center;'><img src='" + base_url + 'public/images/loading.gif' + "' height='180px' /></div><h3>Please wait while we save the design!</h3>",
                    title: "Saving Design",
                    onEscape: function() {},
                    show: true,
                    animate: true,
                });
                // console.log('ajax initiated');
            },
            success: function(msg) {
                // 
                bootbox.hideAll();
                if (msg != 'error') {
                    // empty the divs
                    $('#json_div').text('');
                    $('#image_div').text('');
                    $('#image_layer_div').text('');
                    //adding urls of files in form/ database
                    $('#templateJsonUrl').val(msg + '_canvas.json');
                    $('#templateImageUrl').val(msg + '_image.json');
                    $('#templateLayerUrl').val(msg + '_image_layer.json');
                    //submit form
                    $('#template_form').submit();
                    $(this).button('reset');
                } else alert('error occured: ' + msg);
            },
            error: function(msg) {
                alert('error ' + msg);
            }
        });
        // alert(prototypefabric.ExportLayer('500','600','500','600'));
        /* Act on the event */
    });
    $("#Explayer").click(function() {
        var ExportHeight = document.getElementById("NewHeightEx").value;
        var ExportWidth = document.getElementById("NewWidthEx").value;
        var Width = parseInt($("#width").val());
        var Height = parseInt($("#height").val());
        //console.log(ExportHeight,ExportWidth);
        //prototypefabric.toggleOverlay();
        prototypefabric.ExportLayer(Width, Height, ExportWidth, ExportHeight);
        //prototypefabric.createOverlay_front();
        // var mtop = Math.abs($('#myCanvas').height()-$('#main-container').height())/2;
        //var mleft = Math.abs($('#myCanvas').width()-tempWidth)/2;
        //console.log('Here '+mtop+':'+mleft);
        // $('.canvas-container').css({
        //     'position' :'absolute',
        //     'margin-left': mleft,
        //     'margin-top':mtop
        // });
    });
    $('#json').click(function() {
        prototypefabric.getjson();
    });
    $("#colorpicker7").colpick({
        color: 'white',
        onChange: function(hsb, hex, rgb, that) {
            $(that).css('background-color', '#' + hex);
            prototypefabric.settextcol('#' + hex);
        },
    }).css('background-color', 'white');
    $("#colorpicker8").colpick({
        color: 'white',
        onChange: function(hsb, hex, rgb, that) {
            $(that).css('background-color', '#' + hex);
            prototypefabric.setsvgcol('#' + hex);
        },
    }).css('background-color', 'white');
});

function rgb_Con(rgb) {
    rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
    return (rgb && rgb.length === 4) ? "#" + ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) + ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) + ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : "";
}