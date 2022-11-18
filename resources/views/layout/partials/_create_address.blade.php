<div class="form-group">
    <label class="form-control-label">Kode Pos</label>
    <input type="text" name="zip_code" class="form-control" id="zip_code" placeholder="Masukan kode pos">
</div>
<div class="form-group {{$errors->has('province_id') ? ' has-error' : ''}}">
    <label for="province_id">Provinsi <span class="text-danger">*</span></label>
    <select name="province_id" class="cek custom-select" id="province" style="width: 100%">
        <option></option>
    </select>
    @if ($errors->has('province_id'))
    <span class="invalid-text">provinsi wajib diisi</span>
    @endif
</div>
<div class="form-group {{$errors->has('city_id') ? ' has-error' : ''}}">
    <label for="city_id">Kab/Kota <span class="text-danger">*</span></label>
    <img src="{{config('belajarin.loading')}}" alt="BelajarinId" width="35" id="loadcity" style="display:none;">
    <select name="city_id" class="custom-select" id="city" style="width: 100%">
        <option></option>
    </select>
    <input type="hidden" value="{{old('city_id')}}" id="oldCity">
    @if ($errors->has('city_id'))
    <span class="invalid-text">kota wajib diisi</span>
    @endif
</div>
<div class="form-group {{$errors->has('district_id') ? ' has-error' : ''}}">
    <label for="district_id">Kecamatan <span class="text-danger">*</span></label>
    <img src="{{config('belajarin.loading')}}" alt="BelajarinId" width="35" id="loaddistrict" style="display:none;">
    <select name="district_id" class="custom-select" id="district" style="width: 100%">
        <option></option>
    </select>
    <input type="hidden" value="{{old('district_id')}}" id="oldDistrict">
    @if ($errors->has('district_id'))
    <span class="invalid-text">kecamatan wajib diisi</span>
    @endif
</div>
<div class="form-group {{$errors->has('village_id') ? ' has-error' : ''}}">
    <label for="village_id">kelurahan/Desa <span class="text-danger">*</span></label>
    <img src="{{config('belajarin.loading')}}" alt="BelajarinId" width="35" id="loadvillage" style="display:none;">
    <input type="hidden" value="{{old('village_id')}}" id="oldVillage">
    <select name="village_id" class="custom-select" id="village" style="width: 100%">
        <option></option>
    </select>
    @if ($errors->has('village_id'))
    <span class="invalid-text">kelurahan wajib diisi</span>
    @endif
</div>
<div class="form-group">
    <label for="detail">Detail Alamat</label>
    <textarea name="detail" class="form-control" id="detail"
        placeholder="Masukan Detail Alamat..">{{old('detail')}}</textarea>
</div>

@push('js')

<script>
    $(document).ready(function () {

        getProvince();

        $('#province').on('change', function () {
            getCity();
        });

        $('#city').on('change', function () {
            getDistrict();
        });

        $('#district').on('change', function () {
            getVillage();
        });

        $('#village').on('change', function () {
            detail()
        });

        function getProvince() {
            $('#loadprovince').show();
            $.ajax({
                url: '/getProvinces',
                type: "GET",
                dataType: "json",
                success: function (data) {
                    let oldProvince = $('#oldProvince').val();
                    $('#province').empty();
                    $.each(data, function (key, value) {
                        if (key == oldProvince) {
                            $('#province').append('<option value="' + key + '" selected>' +
                                value + '</option>');
                        } else {
                            $('#province').append('<option value="' + key + '">' + value +
                                '</option>');
                        }
                    });
                    $('#loadprovince').hide();
                    getCity();
                }
            });
        }

        function getCity() {
            let province_id = $('#province').val();
            if (province_id) {
                $('#loadcity').show();
                $.ajax({
                    url: '/getCities/' + province_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let oldCity = $('#oldCity').val();
                        $('#city').empty();
                        $.each(data, function (key, value) {
                            if (key == oldCity) {
                                $('#city').append('<option value="' + key + '" selected>' +
                                    value + '</option>');
                            } else {
                                $('#city').append('<option value="' + key + '">' + value +
                                    '</option>');
                            }
                        });
                        $('#loadcity').hide();
                        getDistrict();
                    }
                });
            } else {
                $('#city').empty();
            }
        }

        function getDistrict() {
            let city_id = $('#city').val();
            if (city_id) {
                $('#loaddistrict').show();
                $.ajax({
                    url: '/getDistricts/' + city_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let oldDistrict = $('#oldDistrict').val();
                        // console.log(data);
                        $('#district').empty();
                        $.each(data, function (key, value) {
                            if (key == oldDistrict) {
                                $('#district').append('<option value="' + key +
                                    '" selected>' + value + '</option>');
                            } else {
                                $('#district').append('<option value="' + key + '">' +
                                    value + '</option>');
                            }
                        });
                        $('#loaddistrict').hide();
                        getVillage();
                    }
                });
            } else {
                $('#district').empty();
            }
        }

        function getVillage() {
            let district_id = $('#district').val();
            if (district_id) {
                $('#loadvillage').show();
                $.ajax({
                    url: '/getVillages/' + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let oldVillage = $('#oldVillage').val();
                        // console.log(data);
                        $('#village').empty();
                        $.each(data, function (key, value) {
                            if (key == oldVillage) {
                                $('#village').append('<option value="' + key +
                                    '" selected>' + value + '</option>');
                            } else {
                                $('#village').append('<option value="' + key + '">' +
                                    value + '</option>');
                            }
                        });
                        $('#loadvillage').hide();
                        detail()
                    }
                });
            } else {
                $('#village').empty();
            }
        }

        function detail() {
            let str =
                `${$('#village').find(':selected').text()}, ${$('#district').find(':selected').text()}, ${$('#city').find(':selected').text()}, ${$('#province').find(':selected').text()} (${$('#zip_code').val()})`;
            str = str.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                return letter.toUpperCase();
            });
            $('#detail').text(str)
        }
    });

</script>
@endpush
