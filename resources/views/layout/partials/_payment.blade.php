@push('css')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
    src="{{config('app.midtrans_snap_url')}}"
    data-client-key="{{config('app.midtrans_client_key')}}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
@endpush



@push('js')
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    let snaptoken = '{{$snapToken}}';
    function showSnap(){
      window.snap.pay(snaptoken, {
        onSuccess: function(result){          
          alert("Pembayaran Berhasil"); console.log(result);
        location.reload();
        //   window.location.href = '/transactions';
        },
        onPending: function(result){
          alert("Pembayaran Sedang di Proses untuk di validasi"); console.log(result);
        location.reload();
        //   window.location.href = '/transactions';
        },
        onError: function(result){
          alert("pembayaran error"); console.log(result);
        location.reload();
        //   window.location.href = '/transactions';
        },
        onClose: function(){
        //   alert('you closed the popup without finishing the payment');
        //   window.location.href = '/transactions';
        }
      })
    }

    // showSnap();
  </script>
@endpush