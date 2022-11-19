@if ($type == 'Tentor')
    @if ($transaction->status == 'Order')        
        <p class="invoice-details invoice-details-two text-secondary">
            Pesanan Baru
        </p>
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="me-2">
                <form action="/tentor/transactions/{{$transaction->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="status" value="Agree">
                    <button type="submit" class="btn btn-sm btn-primary">Terima</button>
                </form>
            </div>
            <div class="me-2">
                <form action="/tentor/transactions/{{$transaction->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="status" value="Cancel">
                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                </form>
            </div>
          </div>
    @elseif($transaction->status == 'Agree')
        <p class="invoice-details invoice-details-two text-secondary">
            Menunggu panggilan...
        </p>
        <div class="me-2">
            <form action="/tentor/transactions/{{$transaction->id}}" method="post">
                @method('DELETE')
                @csrf
                <input type="hidden" name="status" value="Cancel">
                <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
            </form>                
        </div>
    @elseif($transaction->status == 'Come')
        <p class="invoice-details invoice-details-two text-secondary">
            Pelanggan memanggil anda, bergegaslah untuk datang! Jika sudah sampai,mintalah kepada pelanggan untuk menekan tombol mulai belajar!
        </p>
        <div class="me-2">
            <form action="/tentor/transactions/{{$transaction->id}}" method="post">
                @method('DELETE')
                @csrf
                <input type="hidden" name="status" value="Cancel">
                <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
            </form>                
        </div>
    @elseif($transaction->status == 'Process')
        <p class="invoice-details invoice-details-two text-secondary">
            Anda dan pelanggan sedang dalam proses belajar mengajar! Jika sudah selesai,
            silahkan klik tombol selesai untuk lanjut ke proses pembayaran!
        </p>
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="me-2">
                <form action="/tentor/transactions/{{$transaction->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="status" value="Done">
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </form>
            </div>
            <div class="me-2">
                <form action="/tentor/transactions/{{$transaction->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="status" value="Cancel">
                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                </form>                
            </div>
        </div>
    @elseif($transaction->status == 'Done')
        <p class="invoice-details invoice-details-two text-secondary">
            Menunggu pelanggan melakukan pembayaran.
        </p>
    @elseif($transaction->status == 'PaymentFailed')
        <p class="invoice-details invoice-details-two text-secondary">
            Proses pembayaran gagal atau ditolak, minta pelanggan untuk melakukan pembayaran ulang!
        </p>
    @elseif($transaction->status == 'Paid')
        <p class="invoice-details invoice-details-two text-secondary">
            Paid
        </p>
    @elseif($transaction->status == 'Cancel')
        <p class="invoice-details invoice-details-two text-secondary">
            Dibatalkan
        </p>
    @endif
@elseif($type == 'Student')
    @if ($transaction->status == 'Order')        
        <p class="invoice-details invoice-details-two text-secondary">
            Menunggu persetujuan tentor...
        </p>
        <div class="me">
            <form action="/transactions/{{$transaction->id}}" method="post">
                @method('DELETE')
                @csrf
                <input type="hidden" name="status" value="Cancel">
                <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
            </form>
        </div>
    @elseif($transaction->status == 'Agree')     
        <p class="invoice-details invoice-details-two text-secondary">
            Tentor siap dipanggil.
        </p>
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="me-2">
                <form action="/transactions/{{$transaction->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="status" value="Come">
                    <button type="submit" class="btn btn-primary">Panggil Sekarang</button>
                </form>
            </div>
            <div class="me">
                <form action="/transactions/{{$transaction->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="status" value="Cancel">
                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                </form>
            </div>
        </div>
    @elseif($transaction->status == 'Come')
        <p class="invoice-details invoice-details-two text-secondary">
            Menunggu tentor datang ke tempat anda...jika tentor sudah sampai,silahkan tekan tombol Mulai Belajar untuk memulai proses belajar!
        </p>
        <div class="d-flex flex-row bd-highlight mb-3">
            <div class="me-2">
                <form action="/transactions/{{$transaction->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="status" value="Process">
                    <button type="submit" class="btn btn-primary">Mulai Belajar</button>
                </form>
            </div>
            <div class="me">
                <form action="/transactions/{{$transaction->id}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="status" value="Cancel">
                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                </form>
            </div>
        </div>
    @elseif($transaction->status == 'Process')
        <p class="invoice-details invoice-details-two text-secondary">
            Anda sedang melakukan kegiatan belajar mengajar.
        </p>
    @elseif($transaction->status == 'Done')
        <p class="invoice-details invoice-details-two text-secondary">
            Proses belajar mengajar telah selesai, silahkan lakukan pembayaran!
        </p>
        {{-- <form action="/payment" method="post">
            @csrf
            <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
            <button type="submit" class="btn btn-primary">Pembayaran</button>
        </form> --}}
        {{payment($transaction)}}
        <button type="button" onclick="showSnap()" class="btn btn-primary">Pembayaran</button>
    @elseif($transaction->status == 'PaymentFailed')
        <p class="invoice-details invoice-details-two text-secondary">
            Proses pembayaran anda gagal atau ditolak, silahkan melakukan pembayaran ulang!
        </p>
        {{-- <form action="/payment" method="post">
            @csrf
            <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
            <button type="submit" class="btn btn-primary">Pembayaran</button>
        </form> --}}
        {{payment($transaction)}}
        <button type="button" onclick="showSnap()" class="btn btn-primary">Pembayaran</button>
    @elseif($transaction->status == 'Paid')
        <p class="invoice-details invoice-details-two text-secondary">
            Paid
        </p>
    @elseif($transaction->status == 'Cancel')
        <p class="invoice-details invoice-details-two text-secondary">
            Dibatalkan
        </p>
    @endif
@endif