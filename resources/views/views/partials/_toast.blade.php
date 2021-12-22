<script>
    @if(Session::has('flash_notification.message'))
        var type = "{{ Session::get('flash_notification.level', 'info') }}";
        switch(type){
            case 'info':
                iziToast.info({
                    title: 'Info',
                    message: '{{ Session::get('flash_notification.message') }}',
                    position: 'bottomRight' 
                });
                break;
    
            case 'warning':
                iziToast.warning({
                    title: 'Perhatian',
                    message: '{{ Session::get('flash_notification.message') }}',
                    position: 'bottomRight' 
                });
                break;

            case 'success':
                iziToast.success({
                    title: 'Sukses',
                    message: '{{ Session::get('flash_notification.message') }}',
                    position: 'bottomRight' 
                });
                break;

            case 'error':
                iziToast.error({
                    title: 'Error',
                    message: '{{ Session::get('flash_notification.message') }}',
                    position: 'bottomRight' 
                });
                break;
        }
    @endif
</script>