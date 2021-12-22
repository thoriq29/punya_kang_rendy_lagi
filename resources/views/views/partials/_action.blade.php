<form class="delete" action="{{ $form_url ?? '' }}" method="post" id="delete-form">
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
    @isset ($confirm_url)
        @if ($model->status != 10 && $model->has_paid_off != 1)
            <a href="{{ $confirm_url }}" class="btn btn-circle btn-sm btn-success" title="Konfirmasi Pembayaran"><i class="fa fa-fw fa-money-check"></i></a>
        @endif
    @endisset
</form>