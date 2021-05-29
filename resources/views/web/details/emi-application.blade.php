<div class="emi-application-form">
    <form method="POST" action="/product/apply-emi" enctype="multipart/form-data" id="form--emi-application">
        @csrf
        <input type="hidden" name="product_id" value="{{ $result['detail']['product_data'][0]->products_id }}">
        <div class="form-group row">
            <div class="col-sm-4">
                <label for="">First Name</label>
                <input type="text" name="first_name" class="form-control">
                <span class="text-danger error-first_name error-message-area"></span>
            </div>
            <div class="col-sm-4">
                <label for="">Middle Name</label>
                <input type="text" class="form-control" name="middle_name">
                <span class="text-danger error-middle_name error-message-area"></span>
            </div>
            <div class="col-sm-4">
                <label for="">Last Name</label>
                <input type="text" class="form-control" name="last_name">
                <span class="text-danger error-last_name error-message-area"></span>

            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label for="">Email Address</label>
                <input type="email" class="form-control" name="email">
                <span class="text-danger error-email error-message-area"></span>
            </div>
            <div class="col-sm-4">
                <label for="">Contact Number</label>
                <input type="text" class="form-control" name="contact">
                <span class="text-danger error-contact error-message-area"></span>

            </div>
            <div class="col-sm-4">
                <label for="">Current Address</label>
                <input type="text" class="form-control" name="address">
                <span class="text-danger error-address error-message-area"></span>

            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label for="">Gender</label>
                <select name="gender" id="" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <span class="text-danger error-gender error-message-area"></span>

            </div>
            <div class="col-sm-4">
                <label for="">Date Of Birth (AD)</label>
                <input type="date" class="form-control date_of_birth_ad" name="date_of_birth_ad">
                <span class="text-danger error-date_of_birth_ad error-message-area"></span>
            </div>
            <div class="col-sm-4">
                <label for="">Date of Birth (BS)</label>
                <input type="date" class="form-control date_of_birth_bs" name="date_of_birth_bs">
                <span class="text-danger error-date_of_birth_bs error-message-area"></span>


            </div>
        </div>

        <div class="form-group text-center">
            <label for="" style="font-size: 23px">Do You Have Credit Card?</label>
            <select name="has_card" class="form-control" id="emi-form-has-credit-card">
                <option value="">Please Select</option>
                <option value="1">Yes</option>
                <option value="2">No</option>
            </select>
            <span class="text-danger error-has_card error-message-area"></span>

        </div>

        <div class="form-group text-center">
            <label for="" style="font-size: 23px">Select your bank?</label>
            <select name="bank" class="form-control bank--control">
                <option value="">Which Bank Do You Prefer?</option>
                @foreach ($result['banks'] as $bank)
                    <option value="{{ $bank->id }}" data-name="{{ $bank->name }}">{{ $bank->name }}</option>
                @endforeach
            </select>
            <span class="text-danger error-bank error-message-area"></span>
        </div>

        <div class="d-none no-credit-card">
            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="">Vehicle</label>
                    <select name="vehicle" id="" class="form-control">
                        <option value="">Select Vehicle</option>
                        <option value="2 Wheeler">2 Wheeler</option>
                        <option value="4 Wheleer">4 Wheleer</option>
                        <option value="None">Rented / Leased</option>
                    </select>
                    <span class="text-danger error-vehicle error-message-area"></span>

                </div>
                <div class="col-sm-4">
                    <label for="">Residential Status</label>
                    <select name="residential_status" id="" class="form-control">
                        <option value=""></option>
                        <option value="Company Quarter">Company Quarter</option>
                        <option value="Live With Parents">Live With Parents</option>
                        <option value="Own Property">Own Property</option>
                        <option value="Mortaged to Bank">Mortaged to Bank</option>
                        <option value="Rented / Leased"></option>
                    </select>
                    <span class="text-danger error-residential_status error-message-area"></span>

                </div>
                <div class="col-sm-4">
                    <label for="">No. of Dependents</label>
                    <input type="number" name="no_of_dependencies" class="form-control">
                    <span class="text-danger error-no_of_dependencies error-message-area"></span>

                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-4">
                    <label for="">Occupation</label>
                    <select name="occupation" id="" class="form-control">
                        <option value="">Select Employement</option>
                        <option value="Self Employed / Business">Self Employed / Business</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Pilot">Pilot</option>
                        <option value="CA">CA</option>
                        <option value="Engineer / Architect">Engineer / Architect</option>
                        <option value="Managerial Level">Managerial Level</option>
                        <option value="Clerical Level">Clerical Level</option>
                        <option value="Penson Holder">Penson Holder</option>
                        <option value="Other">Other</option>
                    </select>
                    <span class="text-danger error-occupation error-message-area"></span>
                </div>
                <div class="col-sm-4">
                    <label for="">Montly Income (Rs)</label>
                    <input type="number" name="monthly_income" id="" class="form-control">
                    <span class="text-danger error-monthly_income error-message-area"></span>
                </div>
                <div class="col-sm-4">
                    <label for="">Length of Employment</label>
                    <input type="number" name="employment_length" id="" class="form-control">
                    <span class="text-danger error-employment_length error-message-area"></span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 mb-2">
                    Document Uploads
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="image--upload-section salary-certificate-image text-center">
                        <p>Salary Certificate</p>
                    </div>
                    <br>
                    <input type="file" name="salary_certificate" class="form-salary-certificate emi--image-input"
                        data-image-holder="salary-certificate-image">
                    <span class="text-danger error-salary_certificate error-message-area"></span>

                </div>
                <div class="col-sm-4 mb-3">
                    <div class="image--upload-section citizenship-image text-center">
                        <p>Citizenship Copy</p>
                    </div>
                    <br>
                    <input type="file" name="citizenship" class="form-citizenship emi--image-input"
                        data-image-holder="citizenship-image">
                    <span class="text-danger error-citizenship error-message-area"></span>

                </div>

                <div class="col-sm-4 mb-3">
                    <div class="image--upload-section photo-image text-center">
                        <p>Passport Size Photo</p>
                    </div>
                    <br>
                    <input type="file" name="photo" class="form-photo emi--image-input" data-image-holder="photo-image">
                    <span class="text-danger error-photo error-message-area"></span>

                </div>

            </div>

            


        </div>


        <div class="form-group row">
            <div class="col-sm-3">
                <label>Emi Mode (Month)</label>
                <select name="emi_mode" id="" class="form-control field-emi-mode">
                    <option value=""></option>
                    <option value="6">6</option>
                    <option value="12">12</option>
                    <option value="18">18</option>
                </select>
                <span class="text-danger error-emi_mode error-message-area"></span>

            </div>
            <div class="col-sm-3">
                <label for="">Down Payment</label>
                <input type="text" class="form-control field-down-payment" name="down_payment">
                <span class="text-danger error-down_payment error-message-area"></span>

            </div>
            <div class="col-sm-3">
                <label>Finance Amount</label>
                <input type="hidden" name="finance_amount" class="finance--amount field-finance-amount">
                <input value="{{ $result['detail']['product_data'][0]->products_price }}" type="hidden" class="products_price products_org_price">
                <input type="text" class="products_price form-control finance--amount field-finance-amount" readonly 
                    value="{{ $result['detail']['product_data'][0]->products_price }}">
                <span class="text-danger error-finance_amount error-message-area"></span>

            </div>
            <div class="col-sm-3">
                <label for="">Emi Per Month</label>
                <input type="text" name="emi_per_month" class="form-control field-emi-per-month">
                <span class="text-danger error-emi_per_month error-message-area"></span>
            </div>
        </div>
        <div class="d-none has-credit-card">
            {{-- <div class="form-group text-center">
                <label for="" style="font-size: 23px">Select your bank?</label>
                <select name="bank" id="" class="form-control">
                    <option value="">Select our parther bank</option>
                    @foreach ($result['banks'] as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>

        <div class="form-group text-center">
            <label for="">
                <input type="checkbox" id="down_payment_agreement" required name="down_payment_agreement">
                <b>
                    I agree to pay downpayments & Service Charged to Fatafat Sewa office or their reprensetetive .
                </b>
            </label>
        </div>
        <div class="form-group text-center">
            <label for="">
                <input type="checkbox" id="emi_agreement" required name="emi_agreement">
                <b>I declare that the information I have provided above is accurate and complete to the best of my
                    knowledge. I authorize <span class="bank--control-name">BANK NAME</span>, Fatafat Sewa Pvt. Ltd.
                    and its
                    reprensetative to
                    call
                    or
                    SMS me with reference to my credit Card application.</b>
            </label>
        </div>

        <p class="text-center text-danger agreement-error"></p>
        <div class="form-group text-center">
            <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
            <button type="button" class="btn--form-submit btn btn-secondary btn-lg">Submit</button>
        </div>
    </form>
    <div>
        <script>
            let form_validated = false
            $(document).ready(function() {
                $(document).on('change', '#emi-form-has-credit-card', function() {
                    var answer = $(this).val();
                    if (answer === '1') {
                        $('.has-credit-card').removeClass('d-none')
                        $('.no-credit-card').addClass('d-none')
                    } else {
                        $('.no-credit-card').removeClass('d-none')
                        $('.has-credit-card').addClass('d-none')
                    }
                })


                $(document).on('change', '.emi--image-input', function() {
                    let file = $(this).prop('files')[0]
                    var fileType = file["type"];
                    var validImageTypes = ["image/jpeg", "image/png"];
                    var image_holder = $(this).data('image-holder');
                    console.log(image_holder)
                    if ($.inArray(fileType, validImageTypes) < 0) {
                        alert('Only images are allowed')
                        $(this).val(null);
                    } else {
                        let reader = new FileReader();
                        reader.onload = () => {
                            $(`.${image_holder}`).html(
                                `<img src="${reader.result}" style="width:100%">`)
                        };
                        reader.readAsDataURL(file);
                    }
                })

                $(document).on('click', '.btn--form-submit', function(e) {
                    // let formdata = $("#form--emi-application").serializeArray();
                    
                    var form = $('#form--emi-application')[0];
                    console.log(form)
                    var formdata = new FormData(form);
                    // console.log(formdata);
                    if(!$('#down_payment_agreement').is(':checked') || !$('#emi_agreement').is(':checked')){
                        $('.agreement-error').html("Please agree our terms and conditions to proceed.")
                        return;
                    }else{
                        $('.agreement-error').empty()
                    }

                    let has_error = false
                    if (!form_validated) {
                        $.ajax({
                            type: "POST",
                            processData: false,
            contentType: false,
                            url: '/product/apply-emi/validate',
                            data: formdata,
                            success: function(res) {
                                console.log(res.success)
                                if (res.success == true) {
                                    form_validated = true;
                                }
                            },
                            // },
                            error: function(error) {
                                $('.error-message-area').empty();
                                let errors = error.responseJSON.errors
                                for (error in errors) {
                                    $(`.error-${error}`).text(errors[error][0]);
                                }
                                form_validated = false
                               e.preventDefault();

                            }
                        }).done(function() {
                            $("#form--emi-application").submit()
                        }).fail(function() {
                            e.preventDefault();
                        })
                        e.preventDefault();
                    } else {
                        $("#form--emi-application").submit()
                    }
                })

                $(document).on('change', '.bank--control', function() {
                    var bank_name = $(this).find(':selected').attr('data-name')
                    $('.bank--control-name').html(bank_name)
                })

                $(document).on('change', '.field-down-payment', function() {
                    calculateEmi()
                })

                $(document).on('change', '.field-emi-mode', function() {
                    calculateEmi()
                })

                function calculateEmi() {
                    let product_price = $('.products_org_price').val();
                    let emi_mode = $('.field-emi-mode').val();
                    let down_payment = $('.field-down-payment').val();
                    if (down_payment !== null && down_payment !== '') {
                        let finance_amount = product_price - down_payment
                        $('.field-finance-amount').val(finance_amount);

                        if (emi_mode !== null && emi_mode !== "") {
                            let emi_per_month = finance_amount / emi_mode
                            $('.field-emi-per-month').val(emi_per_month);

                        }
                    }

                }


                $(document).on('change', '.date_of_birth_ad', function() {
                    let date_ad = $(this).val()
                    let date_splitted = date_ad.split('-')
                    var bsConvertor=new BikramSambatConverter();
                    var bs_date=bsConvertor.eng_to_nep(parseInt(date_splitted[0]), parseInt(date_splitted[1]), parseInt(date_splitted[2]));
                    $('.date_of_birth_bs').val(bs_date.year+'-'+("0" + bs_date.month).slice(-2)+'-'+("0" + bs_date.date).slice(-2))
                })

                $(document).on('change', '.date_of_birth_bs', function() {
                    let datebs = $(this).val()
                    let date_splitted = datebs.split('-')
                    var bsConvertor=new BikramSambatConverter();
                    var ad_date=bsConvertor.nep_to_eng(parseInt(date_splitted[0]), parseInt(date_splitted[1]), parseInt(date_splitted[2]));
                    $('.date_of_birth_ad').val(ad_date.year+'-'+("0" + ad_date.month).slice(-2)+'-'+("0" + ad_date.date).slice(-2))
                })
            })

        </script>
        <style>
            .emi-application-form .image--upload-section {
                background: rgba(128, 128, 128, 0.102);
                /* height: 150px; */
                border: 1px solid rgba(128, 128, 128, 0.664)
            }

            .emi-application-form .image--upload-section p {
                font-size: 16px;
                padding-top: 60px;
                padding-bottom: 60px;
            }

            /* 
            .error-message-area {
                border: 1px red solid !important;
                background: #ff00002b !important
            } */

        </style>
