$(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    setTimeout(function() {  $(".alert-success").stop().slideUp(500);   }, 5000);
    setTimeout(function() {  $(".alert-danger").stop().slideUp(500);   }, 5000);
    setTimeout(function() {  $(".alert-warning").stop().slideUp(500);   }, 5000);

    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.nav-sidebar a').filter(function() {
      return this.href == url;
    }).addClass('active');

    // for treeview
    $('ul.nav-treeview a').filter(function() {
      return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
});

$(document).on('change', '.js-switch', function (e) {
    var status = $(this).prop('checked') === true ? 1 : 0;
    var url = $(this).data('url');
    var Id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: url,
        data: {'status': status, 'id': Id},
        dataType: "json",
        success: function (data) {
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
    });

    return false;
});

$(document).on('click', '.delete-confirmation', function(event) {
    event.preventDefault();
    var form = $(this).closest("form");

    swal({
        title: "Are you sure to delete?",
        text: "You will not be able to recover this record!",
        icon: "warning",
        buttons: ["No, cancel!", "Yes, delete it!"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });

    return false;
});

$('#checkAll').on('click', function(e) {
    if($(this).is(':checked',true))  {
        $(".sub-check").prop('checked', true);  
    } else {  
        $(".sub-check").prop('checked',false);  
    }
});

$(document).on('click', '.delete-all', function(e) {

    var all_ids = [];  
    $(".sub-check:checked").each(function() {  
        all_ids.push($(this).attr('data-id'));
    });  

    if(all_ids.length <= 0) {
        toastr.options.closeButton = true;
        toastr.options.closeMethod = 'fadeOut';
        toastr.options.closeDuration = 100;
        toastr.error("Please select atleast one row!");  
    } else { 
        swal({
            title: "Are you sure to delete selected records?",
            text: "You will not be able to recover these records!",
            icon: "warning",
            buttons: ["No, cancel!", "Yes, delete it!"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'DELETE',
                    url: $(this).data('url'),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: { ids: all_ids },
                    success: function (data) {
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);

                        $('#example1').DataTable().ajax.reload();
                        setTimeout(function () {
                            $('#checkAll').prop('checked', false);
                            // location.reload();
                        }, 5000);
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
            }
        });          
    }

    return false;  
});

// Checkbox checked
function checkAllCheckbox() {
    // Total checkboxes
    var length = $('.sub-check').length;

    // Total checked checkboxes
    var totalchecked = 0;
    $('.sub-check').each(function() {
        if($(this).is(':checked')) {
            totalchecked += 1;
        }
    });

    // Checked unchecked checkbox
    if(totalchecked == length) {
        $("#checkAll").prop('checked', true);
    } else {
        $('#checkAll').prop('checked', false);
    }
}
