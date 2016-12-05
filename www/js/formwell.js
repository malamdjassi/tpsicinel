
tinymce = null;

// Array used as error collection
var errors = [],

    // Validation configuration
    conf = {
        onElementValidate: function(valid, $el, $form, errorMess) {
            if (!valid) {
                // gather up the failed validations
                errors.push({
                    el: $el,
                    error: errorMess
                });
            }
        }
    };

$().ready(function() {
    //		adapt();
    	$('form').ajaxForm(function() { 
        console.log(this.id);
        });
     

/*
    $.validate({
        modules: 'html5, security',
        lang: 'pt'
    });
*/

    $('.bt-send').each(function() {
        var datasend = "#" + $(this).attr("data-target");
        $($(this).on("click", function() {
            $(datasend).ajaxSubmit({
                beforeSubmit: function(arr, $form, options) {

                    $(datasend + " :checkbox").each(function(ckb) {
                        var newobj = [];
                        var found = false;
                        var check = $(this);
                        $.each(arr, function(key, val) {
                            if (val.name == check.attr('name')) {
                                found = true;
                                $(val).attr('value', check.is(':checked').toString());

                            }
                        });
                        if (!found) {
                            newobj['name'] = $(this).attr('name');
                            newobj['value'] = $(this).is(':checked').toString();
                            console.log("this: " + newobj);

                            arr.push(newobj);
                        }
                        //	console.log(arr);
                    });
                    $(arr).each(function() {

                        if (this.type == "textarea" && null != tinymce) {
                            var edd = tinymce.get(this.name);
                            this.value = edd.getContent();
                            console.log(this);
                        }
                    });
                    return $(this).isValid({}, conf, true);
                },
                success: function(responseText, statusText, xhr, $form) {
                    $.each($(datasend).find(".alert"), function(key, val) {
                        $(val).hide();
                    });
                    $.each($(datasend).find(".alertas"), function(key, val) {
                        $(val).show();
                    });
                    $.each($(datasend).find(".alert"), function(key, val) {
                        $(val).hide();
                    });
                    var obj = jQuery.parseJSON(responseText);
                    if (obj.ok == 1 || obj.errcode == 200) {
                        $.each($('body').find(".modal_crud"), function(key, val) {
                            $(val).modal('hide');
                        });
                        $($(datasend).find('.alert.alert-success')).show();
                    } else {
                        $($(datasend).find('.alert.alert-danger')).show();
                    }


                    console.log(responseText);
                },
                data: {
                    collect: coltab
                }
            });
        })); // end button click
    });

    /*$('.modal_crud').on('hidden.bs.modal', function (e) {
      $('#tableres').bootstrapTable('refresh',{});
      });

      if ($('#tableres').length > 0)
      $('#tableres').bootstrapTable({
      url: $('#tableres').attr('data-target'),
      method: 'post',
      pagination : true,
      sortable : true,
      search : true,
      queryParams: function(p) {
      return {op: 'r', collect: coltab, xtra: $('#tableres').attr('data-xtra')}
      },
      columns: saveCollect(minuscol)
      });
     */

    demoUpload();
    if ((".bt-send").length > 0)
        defaultValues();
});


function defaultValues() {
    var vals = {
        op: "r",
        di: $('#di').val(),
        collect: coltab
    };
    var isval = false;
    $.post("handler/db_handler.php", vals, function(data, status) {
        $('#op').val((data.length > 0) ? 'u' : 'c');
        // 		isval = ;
        $.each(data[0], function(key, value) {
            if (value)
                isval = true;
            if (key.indexOf("pass") == -1)
                $("body").find('#' + key).val(value);
            if (key == "_id")
                $('#id').val(value.$id);
        });

    });
}


function operateFormatter(value, row, index) {
    return [xtrabuttons,
        '<a class="update" href="javascript:void(0)" title="Update" style="margin-right: 25px;">',
        '<i class="glyphicon glyphicon-pencil"></i>',
        '</a>  ',
        '<a class="remove" href="javascript:void(0)" title="Remove">',
        '<i class="glyphicon glyphicon-trash"></i>',
        '</a>'
    ].join('');
}
window.operateEvents = {
    'click .update': function(e, value, row, index) {
        $.each(row, function(key, value) {
            $("body").find('#' + key).val(value);
        });
        $('#op').val('u');
        if (row._id != null)
            $('#id').val(row._id.$id);
        $('#pos').val(index);
        $('.modal_crud').modal('show');


        //		alert('You click like action, row: ' + JSON.stringify(row));
    },
    'click .remove': function(e, value, row, index) {
        debugger;
        bootbox.confirm("Tem a certeza que pretende apagar '" + row.nome + "'?", function(result) {
            if (result) {
                var data = {
                    op: 'd',
                    di: (row._id != null) ? row._id.$id : '',
                    xtra: $('#tableres').attr('data-xtra'),
                    collect: coltab
                };
                $.post($('#tableres').attr('data-target'), data, function(dat, status, xhr) {
                    var obj = jQuery.parseJSON(dat);
                    // console.log(obj);
                    if (obj.ok == 1 || obj.errcode == 200) {
                        $.each($('body').find(".modal_crud"), function(key, val) {
                            $(val).modal('hide');
                        });
                        $('#tableres').bootstrapTable('refresh', {});
                    }

                });
            }
        });
    },
    'click .xtra1': ((undefined == onclickextra) ? function(e, v, r, i) {} : onclickextra)
};

function restartForm() {
    $('#' + active)[0].reset();
    $('#op').val('c');
    $('#id').val('c');
}

function saveCollect(exc) {
    var elem = [];
    $('.modal_crud').find('input').each(
        function(dat) {
            if ($.inArray(this.id, exc) == -1) {
                elem.push(this);
            }
        });
    $('.modal_crud').find('textarea').each(
        function(dat) {
            if ($.inArray(this.id, exc) == -1) {
                elem.push(this);
            }
        });

    var cols = [];
    $.each(elem, function(key, val) {
        if (val.type != "hidden") {

            var inp = {
                title: $(val).closest('.form-group').find('label').text(),
                field: val.id,
                sortable: true
            };
            if (val.type == "checkbox") {
                inp.formatter = function(val, row, index) {
                    var src = 'http://freeiconbox.com/icon/256/21104.png';
                    if (val != '')
                        src = val;
                    return '<input type="checkbox" ' + ((val == "true") ? "checked" : "") + '/>';
                }
                inp.align = 'center';
            } else if (val.id == 'foto') {
                inp.formatter = function(val, row, index) {
                    var src = 'http://freeiconbox.com/icon/256/21104.png';
                    if (val != '')
                        src = val;
                    return '<img height="75px" class="img-circle" src="' + src + '"/>';
                }
                inp.align = 'center';
            }

            cols.push(inp);
        }
    });

    cols.push({
        align: 'center',
        events: operateEvents,
        formatter: operateFormatter
    });

    return cols;
}

function activateFile() {
    $('#upfile').click();
}

function demoUpload() {
    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                });
                $('.upload-demo').addClass('ready');
            }

            reader.readAsDataURL(input.files[0]);

            $('#choosePhoto').toggle('false');
            $('#uploadphoto').toggle('true');
        } else {
            swal("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    if ($('#uploadphoto').length > 0)
        $uploadCrop = $('#uploadphoto').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 250,
                height: 250
            },
            update: function(bla) {
                $('#uploadphoto').croppie('result', 'canvas').then(function(src) {
                    //				$('#postres').attr('src', src);
                    $('#foto').val(src);
                });
                //			console.log("updated" + bla);
            }
        });

    $('#upfile').on('change', function() {
        readFile(this);
    });
}
