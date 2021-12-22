<form class="delete" action="{{  $form_url ?? $form_action ?? ''}}" method="post" id="delete-form">
    {{csrf_field()}}
    {{method_field('delete')}}
    @isset ($show_url)
        <a href="{{ $show_url }}" class="btn btn-circle btn-sm btn-info" title="Lihat Detail"><i class="fa fa-fw fa-eye"></i></a>
    @endisset
    @isset ($edit_url)
        <a href="{{ $edit_url }}" class="btn btn-circle btn-sm btn-warning" title="Edit Data"><i class="fa fa-fw fa-edit"></i></a>
    @endisset
    @isset ($cancel_url)
        @if ($model->status != 10 && $model->status != 200 && $model->status != 210 && $model->status != 300 && $model->has_paid_off != 1)
            <a href="{{ $cancel_url }}" class="btn btn-circle btn-sm btn-danger" title="Batalkan Order"><i class="fa fa-fw fa-times"></i></a>
        @endif
    @endisset
    @isset ($form_url)
        <button type="submit" value="Delete" class="btn btn-circle btn-sm btn-danger js-submit-confirm" title="Hapus Data">
            <i class="fa fa-trash"></i>
        </button>
    @endisset
    @isset ($update_status_form_url)
        <button type="submit" value="Delete" class="btn btn-circle btn-sm {{$status == 1 ? 'btn-danger' : 'btn-success'}} js-submit-confirm{{$status == 0 ? '-active' : ''}}" title="{{$status == 1 ? 'Hapus Data' : 'Aktifkan'}}">
            @if($status == 1)
            <i class="fa fa-trash"></i>
            @else 
                <i class="fa fa-check"></i>
            @endif
        </button>
    @endisset
    @isset ($update_status_user_form_url)
        @if($role == "member" && $admin_roles == "admin")
        <button type="submit" value="Delete" class="btn btn-circle btn-sm {{$status == 1 ? 'btn-danger' : 'btn-success'}} js-submit-confirm{{$status == 0 ? '-active' : ''}}" title="{{$status == 1 ? 'Hapus Data' : 'Aktifkan'}}">
            @if($status == 1)
            <i class="fa fa-trash"></i>
            @else 
                <i class="fa fa-check"></i>
            @endif
        </button>
        @endif
    @endisset
    @isset ($confirm_url)
        @if ($model->status != 10 && $model->has_paid_off != 1)
            <a href="{{ $confirm_url }}" class="btn btn-circle btn-sm btn-success" title="Konfirmasi Pembayaran"><i class="fa fa-fw fa-money-check"></i></a>
        @endif
    @endisset
</form>