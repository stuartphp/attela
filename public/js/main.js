function ucwords (str) {
    str =str.replace(/_/g, ' ');
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}
var IDLE_TIMEOUT = 10; //seconds
var _idleSecondsCounter = 0;
document.onclick = function() {
    _idleSecondsCounter = 0;
};
document.onmousemove = function() {
    _idleSecondsCounter = 0;
};
document.onkeypress = function() {
    _idleSecondsCounter = 0;
};
window.setInterval(CheckIdleTime, 600000);

function CheckIdleTime() {
    _idleSecondsCounter++;
    var oPanel = document.getElementById("SecondsUntilExpire");
    if (oPanel)
        oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
    if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        setTimeout(timeOutWarning(), 1000);

    }
}

function timeOutWarning() {
    Swal.fire({
        position: 'top-end',
        title:'Timeout Warning',
        text:'',
        icon: 'warning',
        showConfirmButton: false,
        timer:10000
    });
    $('#logoutform').trigger('submit');
}
$(function () {
  window._token = $('meta[name="csrf-token"]').attr('content')

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
        allEditors[i],
        {
            removePlugins: ['ImageUpload']
        }
    );
  }

  // moment.updateLocale('en', {
  //   week: {dow: 1} // Monday is the first day of the week
  // })

    $('.date').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'en'
    })

    $('.datetime').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        locale: 'en',
        sideBySide: true
    })

    $('.timepicker').datetimepicker({
        format: 'HH:mm:ss'
    });
  $('.select').select2();

  $('.select-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2');
    $select2.find('option').prop('selected', 'selected');
    $select2.trigger('change');
  });
  $('.deselect-all').click(function () {
    let $select2 = $(this).parent().siblings('.select2');
    $select2.find('option').prop('selected', '');
    $select2.trigger('change');
  });

  // $('.select2').select2()

  $('.treeview').each(function () {
    var shouldExpand = false
    $(this).find('li').each(function () {
      if ($(this).hasClass('active')) {
        shouldExpand = true
      }
    })
    if (shouldExpand) {
      $(this).addClass('active')
    }
  })
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function notice(type, title, message='', time=1500) {
    if(type==='error')
    {
        time=4000;
    }
    Swal.fire({
        position: 'top-end',
        toast: true,
        title:title,
        html:message,
        icon: type,
        showCloseButton: true,showConfirmButton: false,
        timer: time
    });
}

