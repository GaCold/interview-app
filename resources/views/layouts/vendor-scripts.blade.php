<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/plugins/lord-icon-2.1.0.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/jquery-3.6.0.min.js') }}"></script>
<script>
    function notify() {
        setTimeout(function () {
            $('.alert.show').hide('slow')
        }, 7000)
    }

    function alertNoti(type, message) {
        $('.alert-' + type + ' span').html(message)
        $('.alert-' + type).toggleClass('hide show')
    }

    notify()
    alertNoti()

    const swalTitle = "@lang('Are you sure?')"
    const swalTitleCheckIdDelete = "@lang('Please select at least one checkbox')"
    const swalConfirmButtonText = "@lang('Ok')"
    const swalCancelButtonText = "@lang('Cancel')"

    const dropMsgDefault = "@lang('Drag and drop a file here or click')"
    const dropMsgReplace = "@lang('Drag and drop or click to replace')"
    const dropBtnRemove = "@lang('Remove')"
    const dropMsgError = "@lang('Ooops, something wrong happended.')"
    const dropifyMsg = {
        'default': dropMsgDefault,
        'replace': dropMsgReplace,
        'remove': dropBtnRemove,
        'error': dropMsgError
    }
</script>
@yield('script')
@yield('script-bottom')
