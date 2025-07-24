@include('front.includes.header')
<section class="our-register mt120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
                <div class="main-title text-center">
                    <h2 class="title" id="head_hide" style="display: block">YOUR QUOTE REQUEST</h2>
                    {{-- <p class="paragraph">Give your visitor a smooth online experience with a solid UX design</p> --}}
                </div>
            </div>
        </div>
        @php
            // echo '<pre>';
            // print_r($formFields);
            // echo '</pre>';

            $packageEnquiryFormId = session('packages_enquiry_form_id');

            if (isset($packageEnquiryFormId) && $packageEnquiryFormId != '') {
                $display_oldform = 'none';

                $display_newform = 'block';
            } else {
                $display_oldform = 'block';
                $display_newform = 'none';
            }
        @endphp

        <form id="category_form" action="{{ route('package_inquiry') }}" method="POST"
            style="display: {{ $display_oldform }};" enctype="multipart/form-data">
            @csrf

           

            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-xl-6 mx-auto">
                    <div class="log-reg-form search-modal form-style1 bgc-white p50 p30-sm default-box-shadow1 bdrs12">
                        {{-- @if ($package_id != '')
                            <input name="pakage_id" type="hidden" class="form-control" value="{{ $package_id }}">
                        @endif --}}



                        <input name="service_id" type="hidden" class="form-control" value="{{ $service_id }}">
                        <input name="subservice_id" type="hidden" class="form-control" value="{{ $subservice_id }}">


                        <style>
                            .styledRadioLabel {
                                position: relative;
                                display: inline-block;
                                cursor: pointer;
                            }

                            .checkmark {
                                border-radius: 50rem;
                                border: 1px solid #0040E6;
                                padding: 7px 30px;
                                display: inline-block;
                            }

                            .styledRadio:checked~.checkmark {
                                background-color: #0040E6;
                                color: #fff;
                            }

                            .styledRadio {
                                position: absolute;
                                opacity: 0;
                                cursor: pointer;
                                height: 0;
                                width: 0;
                            }
                        </style>

                        <div <?php if(count($result2) == 0) { ?> style="display:none;" <?php } ?>>

                            <label class="form-label fw500 dark-color styledRadioLabel" for="localorintLocal">
                                <input class="styledRadio" id="localorintLocal" name="localorint" type="radio"
                                    value="loc" checked='checked' onclick="hideshow('local');">
                                <span class="checkmark">Local</span>
                            </label>


                            <label class="form-label fw500 dark-color styledRadioLabel" for="localorintInt">
                                <input class="styledRadio" id="localorintInt" name="localorint" value="int"
                                    type="radio" onclick="hideshow('int');">
                                <span class="checkmark">International</span>
                            </label>
                        </div>
                        <script>
                            function hideshow(val) {
                                if (val == 'local') {

                                    $('#form_type').val('Local Move');
                                    $("#localform").show();
                                    $("#intform").hide();
                                } else {
                                    $('#form_type').val('International Move');
                                    $("#localform").hide();
                                    $("#intform").show();
                                }
                            }
                        </script>
                        @php
                            // echo '<pre>';
                            // print_r($result1);
                            // echo '</pre>';
                            // echo '<pre>';
                            // print_r($formFields);
                            // echo '</pre>';
                            // exit();
                        @endphp

                        <input type="hidden" name="form_type" id="form_type" value="Local Move">
                        @php
                            $userdata = Session::get('user');
                            // echo"<pre>";print_r($userdata);echo"</pre>";exit;
                        @endphp

                        @if($userdata == "")
                        
                        <div class="row">
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Full Name:</label>
                                <input id="name_new" name="name_new" type="text" class="form-control"
                                    placeholder="Enter Full Name:" value="">
                                <p class="form-error-text" id="name_new_error" style="color: red; margin-top: 10px;">
                                </p>
                            </div>
                            <div class="mb15">
                                <label class="form-label fw500 dark-color">Phone Number:</label>
                                <input id="mobile_new" name="mobile_new" type="text" class="form-control"
                                    placeholder="Enter Phone Number:" onkeypress="return validateNumber(event)"
                                    value="">
                                <p class="form-error-text" id="mobile_new_error" style="color: red; margin-top: 10px;">
                                </p>
                            </div>

                            {{-- <p class="form-error-text" id="mobile_new_error" style="color: red; margin-top: 10px;"> --}}
                
                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Email ID:</label>
                                <input id="email_new" name="email_new" type="text" class="form-control"
                                    placeholder="Enter Email ID:" value="">
                                <p class="form-error-text" id="email_new_error" style="color: red; margin-top: 10px;">
                                </p>
                            </div>

                            {{-- <p class="form-error-text" id="email_new_error" style="color: red; margin-top: 10px;"> --}}
                        </div>
                        @endif
                        <div class="row" id="localform">
                            @for ($i = 0; $i < count($result1); $i++)
                                @for ($k = 0; $k < count($formFields); $k++)

                                    @php

                                        $form_additionalData = DB::table('form_attributes')
                                            ->select('*')
                                            ->where('form_id', '=', $result1[$i]->id)
                                            ->get()
                                            ->toArray();
                                        // echo '<pre>';
                                        // print_r($form_additionalData);
                                        // echo '</pre>';
                                        // exit();

                                        $required = $formFields[$k]->is_active;
                                    @endphp
                                    @if ($result1[$i]->lable_name == $formFields[$k]->lable_name)
                                        @if ($result1[$i]->type == '1')
                                            <div class="mb15" id="hide_div_{{ $formFields[$k]->id }}">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}" id="formfield_label_{{ $formFields[$k]->id }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value=" {{ $result1[$i]->id }}">
                                                <input name="formfield_value[]" type="text"
                                                    class="form-control {{ $formFields[$k]->id }}"
                                                    id="formfield_value_{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}">

                                                    <p class="form-error-text" id="name_error_{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                            </div>
                                            
                                        @endif

                                        @if ($result1[$i]->type == '2' && $result1[$i]->lable_name != 'Do you require any additional service?')
                                            <div class="form-group mb-3">
                                                <label class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}"
                                                    for="country">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value="{{ $result1[$i]->id }}">
                                                <select class="form-control searches_drop_{{ $formFields[$k]->id }}"
                                                    id="formfield_value_test{{ $formFields[$k]->id }}"
                                                    name="formfield_value[]"
                                                    onchange="get_sub_select(this.value,'{{ $formFields[$k]->id }}')">
                                                    <option value="">Select {{ $formFields[$k]->lable_name }}
                                                    </option>

                                                    
                                                    @if($formFields[$k]->id == 20)

                                                        @php
                                                           if($subservice_id == 23){
                                                                $in_array = array(56);
                                                           }elseif($subservice_id == 26){
                                                                $in_array = array(57);
                                                           }elseif($subservice_id == 53){
                                                                $in_array = array(496);
                                                           }else{
                                                                $in_array = array();
                                                           }
                                                        @endphp

@foreach ($form_additionalData as $form_additional)
@if(in_array($form_additional->id, $in_array))
    <option value="{{ $form_additional->id}}">
        {{ $form_additional->form_option }}
    </option>
@endif
@endforeach

                                                    @else

                                                        @foreach ($form_additionalData as $form_additional)
                                                            <option value="{{ $form_additional->id }}"
                                                                @if ($form_additional->form_id == 39 && $form_additional->form_option == 'UAE' || $form_additional->form_id == 39 && $form_additional->form_option == 'United Arab Emirates') selected @endif>
                                                                {{ $form_additional->form_option }}</option>
                                                        @endforeach

                                                    @endif
                                                </select>
                                                <p class="form-error-text"
                                                    id="drop_down_error_formfield_value_{{ $formFields[$k]->id }}"
                                                    style="color: red; margin-top: 10px;"></p>
                                                <span id="replace_select_{{ $formFields[$k]->id }}"></span>
                                            </div>
                                        @endif

                                        @if ($result1[$i]->type == '3')
                                            <label
                                                class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>

                                            <input name="form_field_radio_id_one[]" type="hidden" class="m-0"
                                                id="form_field_id[]" value="{{ $result1[$i]->id }}">

                                            @foreach ($form_additionalData as $form_additional)
                                                <label> <input name="formfield_radio_{{ $formFields[$k]->id }}"
                                                        type="radio" class="m-0"
                                                        id="formfield_value_{{ $formFields[$k]->id }}" placeholder=""
                                                        value="{{ $form_additional->form_option }}">
                                                    {{ $form_additional->form_option }}</label>
                                            @endforeach
                                            <p class="form-error-text" id="radio_error"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif

                                        @if ($result1[$i]->type == '4')
                                            <br>
                                            <input name="form_field_checkbox_id_one[]" type="hidden" class="m-0"
                                                id="form_field_id[]" value="{{ $result1[$i]->id }}">
                                            <label
                                                class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                            @foreach ($form_additionalData as $form_additional)
                                                <label><input name="formfield_checkbox_{{ $formFields[$k]->id }}[]"
                                                        type="checkbox" class="m-0"
                                                        id="formfield_value_checkbox{{ $formFields[$k]->id }}"
                                                        placeholder="" value="{{ $form_additional->form_option }}">
                                                    {{ $form_additional->form_option }}</label>
                                            @endforeach
                                            <p class="form-error-text"
                                                id="formfield_value_checkbox1{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif
                                        @if ($result1[$i]->type == '5')
                                            <input name="form_field_id[]" type="hidden" class="m-0"
                                                id="form_field_id[]" value="{{ $result1[$i]->id }}">
                                            <label
                                                class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                            <textarea name="formfield_value[]" id="formfield_value_textarea{{ $formFields[$k]->id }}"
                                                placeholder="{{ $formFields[$k]->lable_name }}"></textarea>

                                            <p class="form-error-text" id="textarea_error"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif
                                        @if ($result1[$i]->type == '6')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value=" {{ $result1[$i]->id }}">
                                                <input name="formfield_value[]" type="date" class="form-control"
                                                    id="formfield_value_date{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}" class="">
                                            </div>
                                            <p class="form-error-text"
                                                id="formfield_value_date12{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif

                                        @if ($result1[$i]->type == '7')
                                            <div class="form-group mb-3">
                                                <label class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}"
                                                    for="country">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_mul_dropdown_id[]" type="hidden"
                                                    class="m-0" id="form_field_id[]"
                                                    value="{{ $formFields[$k]->id }}">
                                                <select class="form-control multiple"
                                                    id="formfield_value_{{ $formFields[$k]->id }}"
                                                    name="formfield_mul_dropdown_{{ $formFields[$k]->id }}[]"
                                                    multiple="multiple">
                                                    <option value="">Select {{ $formFields[$k]->lable_name }}
                                                    </option>
                                                    @foreach ($form_additionalData as $form_additional)
                                                        <option value="{{ $form_additional->form_option }}">
                                                            {{ $form_additional->form_option }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="form-error-text" id="mul_drop_error_{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif
                                        {{-- @if ($result1[$i]->type == '8')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value=" {{ $result1[$i]->id }}">
                                                <input name="formfield_Image_value[]" type="file"
                                                    class="form-control {{ $formFields[$k]->id }}"
                                                    id="formfield_value_Image{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}">
                                            </div>
                                            <p class="form-error-text" id="file_error_{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif --}}
                                        @if ($result1[$i]->type == '8')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id_image[]" type="hidden" class="m-0"
                                                    id="form_field_id" value="{{ $result1[$i]->id }}">
                                                <input name="formfield_Image_value{{ $formFields[$k]->id }}[]"
                                                    type="file" class="form-control {{ $formFields[$k]->id }}"
                                                    id="formfield_value_Image{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}" multiple>
                                            </div>
                                            <p class="form-error-text" id="file_error_{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;"></p>
                                        @endif
                                        @if ($result1[$i]->type == '9')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value=" {{ $result1[$i]->id }}">
                                                <input name="formfield_value[]" type="time" class="form-control"
                                                    id="formfield_value_time{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}" class="">
                                            </div>
                                            <p class="form-error-text"
                                                id="formfield_value_time_one{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif
                                    @endif
                                @endfor
                            @endfor
                        </div>

                        <div class="row" id="intform" style="display:none;">
                            @for ($i = 0; $i < count($result2); $i++)
                                @for ($k = 0; $k < count($formFields); $k++)
                                    @php

                                        $form_additionalData = DB::table('form_attributes')
                                            ->select('*')
                                            ->where('form_id', '=', $result2[$i]->id)
                                            ->get()
                                            ->toArray();
                                        // echo '<pre>';
                                        // print_r($form_additionalData);
                                        // echo '</pre>';
                                        // exit();

                                        $required = $formFields[$k]->is_active;
                                    @endphp
                                    @if ($result2[$i]->lable_name == $formFields[$k]->lable_name)
                                        @if ($result2[$i]->type == '1')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value=" {{ $result2[$i]->id }}">
                                                <input name="formfield_value[]" type="text" class="form-control"
                                                    id="formfield_value_123{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}" class="">

                                                <p class="form-error-text" id="name2_error_{{ $formFields[$k]->id }}"
                                                    style="color: red; margin-top: 10px;">
                                                </p>
                                            </div>
                                        @endif
                                        @if ($result2[$i]->type == '2' && $result2[$i]->lable_name != 'Do you require any additional service?')
                                            <div class="form-group mb-3">
                                                <label class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}"
                                                    for="country">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value="{{ $result2[$i]->id }}">
                                                <select class="form-control searches_drop_{{ $formFields[$k]->id }}"
                                                    id="formfield_value_drop{{ $formFields[$k]->id }}"
                                                    name="formfield_value[]"
                                                    onchange="get_sub_select_two(this.value,'{{ $formFields[$k]->id }}')">
                                                    <option value="">Select {{ $formFields[$k]->lable_name }}
                                                    </option>
                                                    @foreach ($form_additionalData as $form_additional)
                                                        <option value="{{ $form_additional->id }}"
                                                            {{-- @if ($form_additional->form_id == 57 && $form_additional->form_option == 'UAE') selected @endif --}}>
                                                            {{ $form_additional->form_option }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="form-error-text"
                                                    id="drop_down_error_formfield_value_drop{{ $formFields[$k]->id }}"
                                                    style="color: red; margin-top: 10px;">
                                                </p>
                                                <span id="replace_select_two{{ $formFields[$k]->id }}"></span>
                                            </div>
                                        @endif
                                        {{-- @if ($result2[$i]->type == '3')
                                            <label
                                                class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>

                                            <input name="form_field_radio_id[]" type="hidden" class="m-0"
                                                id="form_field_id[]" value="{{ $formFields[$k]->id }}">

                                            @foreach ($form_additionalData as $form_additional)
                                                <input name="formfield_radio_{{ $formFields[$k]->id }}"
                                                    type="radio" class="m-0"
                                                    id="formfield_value_radio12{{ $formFields[$k]->id }}"
                                                    placeholder="" value="{{ $form_additional->form_option }}">
                                                <label></label>
                                                <label>{{ $form_additional->form_option }}</label>
                                            @endforeach
                                            <p class="form-error-text"
                                                id="formfield_value_radio123{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif --}}
                                        @if ($result2[$i]->type == '3')
                                            <label
                                                class="form-label fw500 dark-color">{{ $formFields[$k]->lable_name }}</label>

                                            <input name="form_field_radio_id_two[]" type="hidden" class="m-0"
                                                id="form_field_id[]" value="{{ $result2[$i]->id }}">

                                            @foreach ($form_additionalData as $form_additional)
                                                <label> <input name="formfield_radio_{{ $formFields[$k]->id }}"
                                                        type="radio" class="m-0"
                                                        id="formfield_value_{{ $formFields[$k]->id }}" placeholder=""
                                                        value="{{ $form_additional->form_option }}">
                                                    {{ $form_additional->form_option }}</label>
                                            @endforeach
                                            <p class="form-error-text"
                                                id="formfield_value_red{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif

                                        @if ($result2[$i]->type == '4')
                                            <br>
                                            <input name="form_field_checkbox_id_two[]" type="hidden" class="m-0"
                                                id="form_field_id[]" value="{{ $result2[$i]->id }}">
                                            <label
                                                class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                            @foreach ($form_additionalData as $form_additional)
                                                <label><input name="formfield_checkbox_{{ $formFields[$k]->id }}[]"
                                                        type="checkbox" class="m-0" id="formfield_value[]"
                                                        placeholder="" value="{{ $form_additional->form_option }}"
                                                        id="formfield_value_{{ $formFields[$k]->id }}">
                                                    {{ $form_additional->form_option }}</label>
                                            @endforeach
                                            <p class="form-error-text"
                                                id="formfield_value_c2{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif
                                        {{-- @if ($result2[$i]->type == '5')
                                            <input name="form_field_id[]" type="hidden" class="m-0"
                                                id="form_field_id[]" value="{{ $formFields[$k]->id }}">
                                            <label
                                                class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                            <textarea name="formfield_value[]" type="checkbox" class="m-0"
                                                id="formfield_value_textarea{{ $formFields[$k]->id }}" placeholder="{{ $formFields[$k]->lable_name }}"
                                                value=""></textarea>
                                            <label></label>&nbsp;
                                            <p class="form-error-text" id="textarea2_error"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif --}}
                                        @if ($result2[$i]->type == '5')
                                            <input name="form_field_id[]" type="hidden" class="m-0"
                                                id="form_field_id[]" value="{{ $result2[$i]->id }}">
                                            <label
                                                class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                            <textarea name="formfield_value[]" id="formfield_value{{ $formFields[$k]->id }}"
                                                placeholder="{{ $formFields[$k]->lable_name }}"></textarea>

                                            <p class="form-error-text"
                                                id="formfield_value_01{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif

                                        {{-- @if ($result2[$i]->type == '6')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value=" {{ $formFields[$k]->id }}">
                                                <input name="formfield_value[]" type="date" class="form-control"
                                                    id="formfield_value_date{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}" class="">
                                            </div>
                                            <p class="form-error-text"
                                                id="formfield_value_date_test{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif --}}
                                        @if ($result2[$i]->type == '6')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value=" {{ $result2[$i]->id }}">
                                                <input name="formfield_value[]" type="date" class="form-control"
                                                    id="formfield_value{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}" class="">
                                            </div>
                                            <p class="form-error-text"
                                                id="formfield_value_date_2{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif

                                        @if ($result2[$i]->type == '7')
                                            <div class="form-group mb-3">
                                                <label class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}"
                                                    for="country">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="formfield_mul_dropdown_[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value="{{ $result2[$i]->id }}">
                                                <select class="form-control multiple"
                                                    id="formfield_value_mul_test2{{ $formFields[$k]->id }}"
                                                    name="formfield_mul_dropdown_{{ $formFields[$k]->id }}[]"
                                                    multiple="multiple">
                                                    <option value="">Select {{ $formFields[$k]->lable_name }}
                                                    </option>
                                                    @foreach ($form_additionalData as $form_additional)
                                                        <option value="{{ $form_additional->form_option }}">
                                                            {{ $form_additional->form_option }}</option>
                                                    @endforeach
                                                </select>
                                                <p class="form-error-text"
                                                    id="mul2_drop_error_{{ $formFields[$k]->id }}"
                                                    style="color: red; margin-top: 10px;">
                                                </p>
                                            </div>
                                        @endif
                                        @if ($result2[$i]->type == '8')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id_image[]" type="hidden" class="m-0"
                                                    id="form_field_id" value="{{ $result1[$i]->id }}">
                                                <input name="formfield_Image_value{{ $formFields[$k]->id }}[]"
                                                    type="file" class="form-control {{ $formFields[$k]->id }}"
                                                    id="formfield_value_Image_two{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}" multiple>
                                            </div>
                                            <p class="form-error-text" id="file_error_two_{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;"></p>
                                        @endif
                                        @if ($result2[$i]->type == '9')
                                            <div class="mb15">
                                                <label
                                                    class="form-label fw500 dark-color {{ $required == 1 ? 'requiredStar' : '' }}">{{ $formFields[$k]->lable_name }}</label>
                                                <input name="form_field_id[]" type="hidden" class="m-0"
                                                    id="form_field_id[]" value=" {{ $result1[$i]->id }}">
                                                <input name="formfield_value[]" type="time" class="form-control"
                                                    id="formfield_value_time_two{{ $formFields[$k]->id }}"
                                                    placeholder="{{ $formFields[$k]->lable_name }}" class="">
                                            </div>
                                            <p class="form-error-text"
                                                id="formfield_value_time_sec{{ $formFields[$k]->id }}"
                                                style="color: red; margin-top: 10px;">
                                            </p>
                                        @endif
                                    @endif
                                @endfor
                            @endfor
                        </div>

                        <div class="d-grid mb20">
                            <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button"
                                style="display: none;">

                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>

                                Loading...

                            </button>
                            <button type="button" class="ud-btn btn-thm default-box-shadow2"
                                onclick="javascript:category_validation()" id="submit_button">Submit</button>


                        </div>

                    </div>
                </div>
            </div>
        </form>


        <form id="category_form_new" action="{{ route('package_inquiry_new') }}" method="POST"
            style="display: {{ $display_newform }};">
            @csrf
            <input name="service_id" id="service_id" type="hidden" class="form-control"
                value="{{ $service_id }}">
            <input name="subservice_id" id="subservice_id" type="hidden" class="form-control"
                value="{{ $subservice_id }}">

            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-xl-7 mx-auto">
                    <div class="log-reg-form search-modal form-style1 bgc-white p30 p30-sm default-box-shadow1 bdrs12">

                        <div class="tab1">

                            @php

                                $userdata = Session::get('user');

                                if (isset($userdata)) {
                                    $name = $userdata['name'];
                                    $mobile = $userdata['mobile'];
                                    $email = $userdata['email'];
                                } else {
                                    $name = '';
                                    $mobile = '';
                                    $email = '';
                                }

                            @endphp

                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Full Name:</label>
                                <input id="name_new" name="name_new" type="text" class="form-control"
                                    placeholder="Enter Full Name:" value="{{ $name }}">
                                <p class="form-error-text" id="name_new_error" style="color: red; margin-top: 10px;">
                                </p>
                            </div>
                            
                            <div class="mb15">
                                <label class="form-label fw500 dark-color">Phone Number:</label>
                                <input id="mobile_new" name="mobile_new" type="number" class="form-control"
                                    placeholder="Enter Phone Number:" onkeypress="return validateNumber(event)"
                                    value="{{ $mobile }}">
                                <p class="form-error-text" id="mobile_new_error" style="color: red; margin-top: 10px;">
                                </p>
                            </div>
                           

                            <div class="mb25">
                                <label class="form-label fw500 dark-color">Email ID:</label>
                                <input id="email_new" name="email_new" type="text" class="form-control"
                                    placeholder="Enter Email ID:" value="{{ $email }}">
                                <p class="form-error-text" id="email_new_error" style="color: red; margin-top: 10px;">
                                </p>
                            </div>
                            

                            {{-- <span id="tab1_error" class="error alert-message valierror" style="display:none;"></span> --}}

                            <button type="button" class="ud-btn btn-thm default-box-shadow2" id="nextBtn12"
                                onclick="get_hide_show(2);">Save</button>
                        </div>

                        <div class="tab2" style="display:none">

                            <div class="col-12">
                                <h5 class="card-title mb-md-4">Please review your request and submit it to start
                                    receiving your quotes.</h5>
                            </div>
                            <div class="">
                                <hr>
                                <div class="font-weight-bold h5">
                                    Service Details
                                </div>

                                @php

                                    $packageEnquiryFormId = session('packages_enquiry_form_id');

                                @endphp
                                @if (isset($packageEnquiryFormId) && $packageEnquiryFormId != '')

                                    @php
                                        $att_data = DB::table('more_formfields_details')
                                            ->where('package_inquiry_id', '=', $packageEnquiryFormId)
                                            ->get();

                                        // echo '<pre>';
                                        // print_r($att_data);
                                        // echo '</pre>';

                                    @endphp

                                    @if (isset($att_data) && $att_data != '')
                                        @php
                                            $displayedLabels = []; // Array to keep track of displayed labels
                                            $i = 0;
                                        @endphp

                                        @foreach ($att_data as $att_data_new)
                                            @php
                                                $form_label = DB::table('form_fileds')
                                                    ->where('id', '=', $att_data_new->form_field_id)
                                                    ->first();
                                                // echo '<pre>';
                                                // print_r($form_label);
                                                // echo '</pre>';
                                                // exit();

                                                $labelName = $form_label->lable_name;
                                                // $labelId = $form_label->id;
                                                $packageEnquiryFormId = session('packages_enquiry_form_id');
                                                $get_more_id = DB::table('more_formfields_details_att')
                                                    ->where('form_id', '=', $att_data_new->form_field_id)
                                                    ->where('package_inquiry_id', '=', $packageEnquiryFormId)
                                                    ->get()
                                                    ->toArray();

                                                // echo '<pre>';
                                                // print_r($get_more_id);
                                                // echo '</pre>';

                                            @endphp

                                            {{-- @if ($att_data_new->formfield_value != '' && !in_array($labelName, $displayedLabels)) --}}
                                            <div class="d-flex justify-content-between my-2">

                                                <div>
                                                    @if ($form_label->id != $i)
                                                        {{ $labelName }}
                                                    @endif
                                                </div>
                                                <div class="font-weight-bold">
                                                    @if (is_numeric($att_data_new->formfield_value) &&
                                                            $att_data_new->form_field_id != 30 &&
                                                            $att_data_new->form_field_id != 60)
                                                        {!! Helper::form_fields_attr($att_data_new->formfield_value) !!}
                                                    @else
                                                        @php
                                                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];
                                                            $extension = pathinfo(
                                                                $att_data_new->formfield_value,
                                                                PATHINFO_EXTENSION,
                                                            );
                                                        @endphp

                                                        @if (in_array(strtolower($extension), $imageExtensions))
                                                            <img style="height: 50px; width: 50px;"
                                                                src="{{ asset('public/upload/enquiry_images/' . $att_data_new->formfield_value) }}" />
                                                        @else
                                                            {{ $att_data_new->formfield_value }}
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                            @if (isset($get_more_id) && count($get_more_id) > 0)
                                                @php
                                                    $sd = 0;
                                                @endphp
                                                @foreach ($get_more_id as $get_more_id_data)
                                                    <div class="d-flex justify-content-between my-2">
                                                        @if ($sd == 0)
                                                            <div>

                                                                @if ($att_data_new->form_field_id == 35 && $att_data_new->formfield_value == 111)
                                                                    {{ 'What days of the week would you like the service' }}
                                                                @else
                                                                    {{ 'Type of Home' }}
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div>

                                                            </div>
                                                        @endif
                                                        <div class="font-weight-bold">
                                                            {!! Helper::form_fields_attr_more($get_more_id_data->more_form_attributes_id) !!}
                                                        </div>
                                                    </div>

                                                    @php
                                                        $sd++;
                                                    @endphp
                                                @endforeach
                                            @endif
                                            @php
                                                $displayedLabels[] = $labelName; // Add label to displayed labels array
                                            @endphp
                                            {{-- @endif --}}
                                            @php
                                                $i = $form_label->id;
                                            @endphp
                                        @endforeach




                                    @endif
                                @endif
                                <hr>
                            </div>

                            <button class="btn btn-primary mb-1" type="button" disabled id="spinner_button_final"
                                style="display: none;">

                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>

                                Loading...

                            </button>
                            <button type="button" class="ud-btn btn-thm default-box-shadow2" id="submit_button_final"
                                onclick="get_hide_show(3);">Get Quote</button>
                        </div>



                        <div class="tab3" style="display:none">

                            {{-- <div class="col-lg-12">
                                <p style="font-size: 30px;color:black !important">Thank you for submitting your request for up to 5
                                    free
                                    quotes on VendorsCity! Your request has been successfully received. Our team is
                                    diligently working on gathering the quotes for you, and vendors will contact you
                                    directly with their offers shortly. Should you have any questions or need further
                                    assistance, please feel free to contact us at support@vendorscity.com or call us at
                                    056 VENDORS (056 836 3677). We're here to assist you every step of the way!</p>
                            </div> --}}
            
                            <div class="container text-center">
                                <div class="step-counter" style="background-color: #685F5E;color: #fff;border-radius: 50%;position: relative;z-index: 5;display: flex;justify-content: center;align-items: center;width: 80px;height: 80px;margin: 0 auto;border-radius: 50%;">
								<i class="fa-solid fa-check" style="font-size: 40px;margin: 0 0 3px 4px;"></i>
								</div>
                                    <h2 style="color: #0040E6;">Thank you for Your Quote Request!</h2>
                                    <p class="textp">Hi <span id="user_name_ajax"></span>, we have received your request for the following service :</p>
                                    <p class="textp"><b><span id="service_name_ajax"></span></b><br>
                                        {{-- Order Number : <span id="order_id_ajax"></span> --}}
                                        <br></p>
                                    {{-- <div><img class="bdrs20" src="{{ asset('public/site/images/order_process.png') }}" alt=""></div> --}}
                                    <!--<div><img class="bdrs20" src="{{ asset('public/site/images/quote-process.png') }}" alt="" style="
                                        width: 100%;
                                    "></div>-->
									<div class="stepper-wrapper">
									  <div class="stepper-item completed">
										<div class="step-counter" style="background-color: #0040E6;color: #fff;"><i class="fa-solid fa-pen-to-square" style="font-size: 35px;margin: 0 0 3px 4px;font-weight: 500;"></i>
										</div>
										<div class="step-name">Received Request</div>
									  </div>
									  <div class="stepper-item completed">
										<div class="step-counter" style="background-color: #FFD312;color: #fff;">
										<i class="fa-light fa-memo-pad" style="font-size: 35px;font-weight: 500;"></i>
										</div>
										<div class="step-name">Compare Qoutes</div>
									  </div>
									  <div class="stepper-item">
										<div class="step-counter" style="background-color: #FFD312;color: #fff;">
										<i class="fa-regular fa-user" style="font-size: 35px;font-weight: 500;"></i>
										</div>
										<div class="step-name">Select a Vendor</div>
									  </div>
									  <div class="stepper-item">
										<div class="step-counter" style="background-color: #FFD312;color: #fff;">
										<i class="fa-solid fa-truck" style="font-size: 35px;margin: 0 0 3px 4px;font-weight: 500;"></i>
										</div>
										<div class="step-name">Receive your Service</div>
									  </div>
									</div>	
				
                                    <p class="textp pt20">You will receive <b>up to 5 quotes  </b> from our trusted vendors within the next <b>2 business days.</b></p>
                                    <p class="textp">A confirmation email has been sent to your email address with further details.</p>
                                    <p class="textp pt20">Each quote will include detailed pricing and service information. You can review the quotes and select the one that best meets your needs based on their rating and review.</p>
                                    <p class="textp pt20"><b>Next Steps:</b></p>
                                    <p class="textp">Our vendors will contact you directly to provide their quotes. You can compare the quotes and choose the best one that fits your requirements. Need Assistance? <a href="{{ route('contact') }}">Contact Us</a></p>
                                    {{-- <p class="textp">Once confirmed, ensure that you are at the specified time and location to <br>receive your</p> --}}
                                </div>
                        </div>



                    </div>
                </div>
            </div>
            

        </form>
    </div>
</section>
@include('front.includes.footer')


<script>
    @for ($k = 0; $k < count($formFields); $k++)
        $(document).ready(function() {
            $('.searches_drop_{{ $formFields[$k]->id }}').select2();
        });
    @endfor
</script>


<script>
    function get_hide_show(id)

    {
        if (id == 1) {

            $(".tab1").css("display", "block");
            $(".tab2").css("display", "none");
        }

        if (id == 2) {


            // var name_new = $('#name_new').val();

            // if (name_new == '') {

            //     $('#tab1_error').html("Please Enter Full Name");

            //     $('#tab1_error').show().delay(0).fadeIn('show');

            //     $('#tab1_error').show().delay(2000).fadeOut('show');

            //     return false;

            // }


            // var mobile_new = $('#mobile_new').val();

            // if (mobile_new == '') {

            //     $('#tab1_error').html("Please Enter Phone");

            //     $('#tab1_error').show().delay(0).fadeIn('show');

            //     $('#tab1_error').show().delay(2000).fadeOut('show');

            //     return false;

            // }


            // if (mobile_new != '') {
            //     // var filter = /^\d{7}$/;
            //     if (mobile_new.length < 7 || mobile_new.length > 15) {

            //         $('#tab1_error').html("Please Enter Valid Phone.");

            //         $('#tab1_error').show().delay(0).fadeIn('show');

            //         $('#tab1_error').show().delay(2000).fadeOut('show');

            //         return false;

            //     }
            // }


            // var email_new = jQuery("#email_new").val();

            // if (email_new == '') {

            //     jQuery('#tab1_error').html("Please Enter Email Id");

            //     jQuery('#tab1_error').show().delay(0).fadeIn('show');

            //     jQuery('#tab1_error').show().delay(2000).fadeOut('show');

            //     return false;

            // }

            // var em1 = jQuery('#email_new').val();

            // var filter1 = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            // if (!filter1.test(em1)) {

            //     jQuery('#tab1_error').html("Please Enter Valid Email Id");

            //     jQuery('#tab1_error').show().delay(0).fadeIn('show');

            //     jQuery('#tab1_error').show().delay(2000).fadeOut('show');

            //     return false;

            // }




            $(".tab1").css("display", "none");
            $(".tab2").css("display", "block");
        }

        if (id == 3) {

            var name_new = $('#name_new').val();
            var mobile_new = $('#mobile_new').val();
            var email_new = jQuery("#email_new").val();

            var service_id = jQuery("#service_id").val();
            var subservice_id = jQuery("#subservice_id").val();



            $('#spinner_button_final').show();

            $('#submit_button_final').hide();

            // alert(service_id);

            var url = '{{ url('package_inquiry_new') }}';

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "email_new": email_new,
                    "name_new": name_new,
                    "mobile_new": mobile_new,
                    "service_id": service_id,
                    "subservice_id": subservice_id,
                },
                success: function(msg) {
                    //alert(msg);

                    var response_ajax = JSON.parse(msg);
                    //document.getElementById('city_data').innerHTML = msg;

                    if (response_ajax.status === "success") {

                        $('#service_name_ajax').html(response_ajax.subservicename);
                        $('#order_id_ajax').html(response_ajax.order_id);
                        $('#user_name_ajax').html(response_ajax.username);

                        $(".tab1").css("display", "none");
                        $(".tab2").css("display", "none");
                        $("#head_hide").css("display", "none");
                        $(".tab3").css("display", "block");
                    }

                }

            });


            //$('#category_form_new').submit();
        }

    }


    function category_validation() {
        var isLocal = $('input[name="localorint"]:checked').val();

        if (isLocal === "loc") {
            // alert("local");
            validateLocalForm();
        } else if (isLocal === "int") {
            // alert("intr");
            validateInternationalForm();
        }
    }






    function validateLocalForm() {
        // Validate local form fields
        // var localFormValid = true;
        // alert(localFormValid);

        
        var name_new = jQuery("#name_new").val();
        if (name_new == '') {

            jQuery('#name_new_error').html("Please Enter Name");
            jQuery('#name_new_error').show().delay(0).fadeIn('show');
            jQuery('#name_new_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#name_new').offset().top - 150
            }, 1000);
            return false;

        }
        var mobile_new = jQuery("#mobile_new").val();
        if (mobile_new == '') {

            jQuery('#mobile_new_error').html("Please Enter Mobile");
            jQuery('#mobile_new_error').show().delay(0).fadeIn('show');
            jQuery('#mobile_new_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#mobile_new').offset().top - 150
            }, 1000);
            return false;

        }
        if (mobile_new != '') {
            // var filter = /^\d{7}$/;
            if (mobile_new.length < 7 || mobile_new.length > 15) {
                jQuery('#mobile_new_error').html("Please Enter Valid Mobile Number");
                jQuery('#mobile_new_error').show().delay(0).fadeIn('show');
                jQuery('#mobile_new_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#mobile_new').offset().top - 150
                }, 1000);
                return false;
            }
        }


        var email_new = jQuery("#email_new").val();

        if (email_new == '') {
            jQuery('#email_new_error').html("Please Enter Email");
            jQuery('#email_new_error').show().delay(0).fadeIn('show');
            jQuery('#email_new_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#email_new').offset().top - 150
            }, 1000);
            return false;
        }



        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email_new)) {

            jQuery('#email_new_error').html("Please Enter Valid Email");
            jQuery('#email_new_error').show().delay(0).fadeIn('show');
            jQuery('#email_new_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#email_new').offset().top - 150
            }, 1000);
            return false;

        }


        // Example: Validate a text field
        @for ($i = 0; $i < count($result1); $i++)
            @for ($k = 0; $k < count($formFields); $k++)
                @if ($result1[$i]->lable_name == $formFields[$k]->lable_name)
                    @if ($result1[$i]->type == '1' && $result1[$i]->is_active == '1')
                        // Define test within the scope
                        var test = jQuery("#formfield_value_{{ $formFields[$k]->id }}").val();
                        if (test == '') {
                            jQuery('#name_error_{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#name_error_{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#name_error_{{ $formFields[$k]->id }}').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_{{ $formFields[$k]->id }}').offset().top - 150
                            }, 1000);
                            return false;
                        }
                    @endif

                    @if ($result1[$i]->type == '2' && $result1[$i]->is_active == '1')
                        var drop_down = jQuery("#formfield_value_test{{ $formFields[$k]->id }}").val();
                        if (drop_down == '') {
                            jQuery('#drop_down_error_formfield_value_{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#drop_down_error_formfield_value_{{ $formFields[$k]->id }}').show().delay(0)
                                .fadeIn('show');
                            jQuery('#drop_down_error_formfield_value_{{ $formFields[$k]->id }}').show().delay(2000)
                                .fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_test{{ $formFields[$k]->id }}').offset().top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result1[$i]->type == '3' && $result1[$i]->is_active == '1')
                        var radioSelected = jQuery('input[name="formfield_radio_{{ $formFields[$k]->id }}"]:checked')
                            .val();

                        if (!radioSelected) {
                            jQuery('#radio_error').html("Please select {{ $formFields[$k]->lable_name }}");
                            jQuery('#radio_error').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_{{ $formFields[$k]->id }}').offset().top - 150
                            }, 1000);
                            return false;
                        }
                    @endif

                    // @if ($result1[$i]->type == '3' && $result1[$i]->is_active == '1')
                    //     var radio = jQuery("#formfield_value_{{ $formFields[$k]->id }}").val();
                    //     // alert(drop_down);
                    //     if (radio == '') {
                    //         jQuery('#radio_error').html("Please Enter {{ $formFields[$k]->lable_name }}");
                    //         jQuery('#radio_error').show().delay(0).fadeIn('show');
                    //         jQuery('#radio_error').show().delay(2000).fadeOut('show');
                    //         $('html, body').animate({
                    //             scrollTop: $('#formfield_value_{{ $formFields[$k]->id }}').offset().top - 150
                    //         }, 1000);
                    //         return false;
                    //     }
                    // @endif

                    @if ($result1[$i]->type == '4' && $result1[$i]->is_active == '1')
                        // var checkbox = jQuery("#formfield_value_checkbox{{ $formFields[$k]->id }}").val();
                        var checkboxes = document.querySelectorAll(
                            'input[name^="formfield_checkbox_{{ $formFields[$k]->id }}"]:checked');
                        // alert(checkbox);
                        if (checkboxes.length === 0) {
                            var errorMessage =
                                jQuery('#formfield_value_checkbox1{{ $formFields[$k]->id }}').html(
                                    "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#formfield_value_checkbox1{{ $formFields[$k]->id }}').show().delay(0).fadeIn(
                                'show');
                            jQuery('#formfield_value_checkbox1{{ $formFields[$k]->id }}').show().delay(2000).fadeOut(
                                'show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_checkbox1{{ $formFields[$k]->id }}').offset()
                                    .top - 150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result1[$i]->type == '5' && $result1[$i]->is_active == '1')
                        var textarea = jQuery("#formfield_value_textarea{{ $formFields[$k]->id }}").val();
                        // alert(drop_down);
                        if (textarea == '') {
                            jQuery('#textarea_error').html("Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#textarea_error').show().delay(0).fadeIn('show');
                            jQuery('#textarea_error').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_textarea{{ $formFields[$k]->id }}').offset()
                                    .top - 150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result1[$i]->type == '6' && $result1[$i]->is_active == '1')
                        var date = jQuery("#formfield_value_date{{ $formFields[$k]->id }}").val();
                        if (date == '') {
                            jQuery('#formfield_value_date12{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#formfield_value_date12{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#formfield_value_date12{{ $formFields[$k]->id }}').show().delay(2000).fadeOut(
                                'show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_date{{ $formFields[$k]->id }}').offset().top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result1[$i]->type == '7' && $result1[$i]->is_active == '1')
                        var mul_drop_down = jQuery("#formfield_value_{{ $formFields[$k]->id }}").val();
                        if (mul_drop_down == '') {
                            jQuery('#mul_drop_error_{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#mul_drop_error_{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#mul_drop_error_{{ $formFields[$k]->id }}').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_{{ $formFields[$k]->id }}').offset().top - 150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result1[$i]->type == '8' && $result1[$i]->is_active == '1')
                        var Image = jQuery("#formfield_value_Image{{ $formFields[$k]->id }}").val();

                        if (Image == '') {
                            jQuery('#file_error_{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#file_error_{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#file_error_{{ $formFields[$k]->id }}').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_Image{{ $formFields[$k]->id }}').offset().top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result1[$i]->type == '9' && $result1[$i]->is_active == '1')
                        var Time = jQuery("#formfield_value_time{{ $formFields[$k]->id }}").val();

                        if (Time == '') {
                            jQuery('#formfield_value_time_one{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#formfield_value_time_one{{ $formFields[$k]->id }}').show().delay(0).fadeIn(
                                'show');
                            jQuery('#formfield_value_time_one{{ $formFields[$k]->id }}').show().delay(2000).fadeOut(
                                'show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_time{{ $formFields[$k]->id }}').offset().top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif
                @endif
            @endfor
        @endfor


           



        // if (!localFormValid) {
        //     return false;
        // }


        $('#spinner_button').show();

        $('#submit_button').hide();

        $('#category_form').submit();

        // Add more validation for other fields as needed

        // If local form is not valid, prevent form submission


        // Proceed with form submission if local form is valid
        // Your form submission code here
    }

    function validateInternationalForm() {

        var name_new = jQuery("#name_new").val();
        if (name_new == '') {

            jQuery('#name_new_error').html("Please Enter Name");
            jQuery('#name_new_error').show().delay(0).fadeIn('show');
            jQuery('#name_new_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#name_new').offset().top - 150
            }, 1000);
            return false;

        }
        var mobile_new = jQuery("#mobile_new").val();
        if (mobile_new == '') {

            jQuery('#mobile_new_error').html("Please Enter Mobile");
            jQuery('#mobile_new_error').show().delay(0).fadeIn('show');
            jQuery('#mobile_new_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#mobile_new').offset().top - 150
            }, 1000);
            return false;

        }
        if (mobile_new != '') {
            // var filter = /^\d{7}$/;
            if (mobile_new.length < 7 || mobile_new.length > 15) {
                jQuery('#mobile_new_error').html("Please Enter Valid Mobile Number");
                jQuery('#mobile_new_error').show().delay(0).fadeIn('show');
                jQuery('#mobile_new_error').show().delay(2000).fadeOut('show');
                $('html, body').animate({
                    scrollTop: $('#mobile_new').offset().top - 150
                }, 1000);
                return false;
            }
        }


        var email_new = jQuery("#email_new").val();

        if (email_new == '') {
            jQuery('#email_new_error').html("Please Enter Email");
            jQuery('#email_new_error').show().delay(0).fadeIn('show');
            jQuery('#email_new_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#email_new').offset().top - 150
            }, 1000);
            return false;
        }



        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email_new)) {

            jQuery('#email_new_error').html("Please Enter Valid Email");
            jQuery('#email_new_error').show().delay(0).fadeIn('show');
            jQuery('#email_new_error').show().delay(2000).fadeOut('show');
            $('html, body').animate({
                scrollTop: $('#email_new').offset().top - 150
            }, 1000);
            return false;

        }

        // var intFormValid = true;
        @for ($i = 0; $i < count($result2); $i++)
            @for ($k = 0; $k < count($formFields); $k++)
                @if ($result2[$i]->lable_name == $formFields[$k]->lable_name)
                    @if ($result2[$i]->type == '1' && $result2[$i]->is_active == '1')
                        // Define test within the scope
                        var test_two = jQuery("#formfield_value_123{{ $formFields[$k]->id }}").val();
                        if (test_two == '') {
                            jQuery('#name2_error_{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#name2_error_{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#name2_error_{{ $formFields[$k]->id }}').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_123{{ $formFields[$k]->id }}').offset().top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif

                    @if ($result2[$i]->type == '2' && $result2[$i]->is_active == '1')
                        // Define drop_down_test within the scope
                        var drop_down_test = jQuery("#formfield_value_drop{{ $formFields[$k]->id }}").val();
                        if (drop_down_test == '') {
                            jQuery('#drop_down_error_formfield_value_drop{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#drop_down_error_formfield_value_drop{{ $formFields[$k]->id }}').show().delay(0)
                                .fadeIn('show');
                            jQuery('#drop_down_error_formfield_value_drop{{ $formFields[$k]->id }}').show().delay(
                                    2000)
                                .fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_drop{{ $formFields[$k]->id }}').offset().top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif


                    @if ($result2[$i]->type == '3' && $result2[$i]->is_active == '1')
                        var radio2 = jQuery('input[name="formfield_radio_{{ $formFields[$k]->id }}"]:checked')
                            .val();

                        if (!radio2) {
                            jQuery('#formfield_value_red{{ $formFields[$k]->id }}').html(
                                "Please select {{ $formFields[$k]->lable_name }}");
                            jQuery('#formfield_value_red{{ $formFields[$k]->id }}').show().delay(2000).fadeOut(
                                'show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_red{{ $formFields[$k]->id }}').offset()
                                    .top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif


                    @if ($result2[$i]->type == '4' && $result2[$i]->is_active == '1')
                        var checkboxes2 = document.querySelectorAll(
                            'input[name^="formfield_checkbox_{{ $formFields[$k]->id }}"]:checked');
                        if (checkboxes2.length === 0) {
                            var errorMessage =
                                jQuery('#formfield_value_c2{{ $formFields[$k]->id }}').html(
                                    "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#formfield_value_c2{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#formfield_value_c2{{ $formFields[$k]->id }}').show().delay(2000).fadeOut(
                                'show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_c2{{ $formFields[$k]->id }}').offset()
                                    .top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result2[$i]->type == '5' && $result2[$i]->is_active == '1')
                        var textareas = jQuery("#formfield_value{{ $formFields[$k]->id }}").val();
                        // alert(textareas);
                        if (textareas == '') {
                            jQuery('#formfield_value_01{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#formfield_value_01{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#formfield_value_01{{ $formFields[$k]->id }}').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value{{ $formFields[$k]->id }}').offset()
                                    .top - 150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result2[$i]->type == '6' && $result2[$i]->is_active == '1')
                        var date_test = jQuery("#formfield_value{{ $formFields[$k]->id }}").val();
                        if (date_test == '') {
                            jQuery('#formfield_value_date_2{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#formfield_value_date_2{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#formfield_value_date_2{{ $formFields[$k]->id }}').show().delay(2000).fadeOut(
                                'show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value{{ $formFields[$k]->id }}').offset().top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif

                    @if ($result2[$i]->type == '7' && $result2[$i]->is_active == '1')
                        var mul_drop_down = jQuery("#formfield_value_mul_test2{{ $formFields[$k]->id }}").val();
                        if (mul_drop_down == '') {
                            jQuery('#mul2_drop_error_{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#mul2_drop_error_{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#mul2_drop_error_{{ $formFields[$k]->id }}').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_mul_test2{{ $formFields[$k]->id }}').offset()
                                    .top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result2[$i]->type == '8' && $result2[$i]->is_active == '1')
                        var Image_int = jQuery("#formfield_value_Image_two{{ $formFields[$k]->id }}").val();

                        if (Image_int == '') {
                            jQuery('#file_error_two_{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#file_error_two_{{ $formFields[$k]->id }}').show().delay(0).fadeIn('show');
                            jQuery('#file_error_two_{{ $formFields[$k]->id }}').show().delay(2000).fadeOut('show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_Image_two{{ $formFields[$k]->id }}').offset()
                                    .top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif
                    @if ($result2[$i]->type == '9' && $result1[$i]->is_active == '1')
                        var time_sec = jQuery("#formfield_value_time_two{{ $formFields[$k]->id }}").val();

                        if (time_sec == '') {
                            jQuery('#formfield_value_time_sec{{ $formFields[$k]->id }}').html(
                                "Please Enter {{ $formFields[$k]->lable_name }}");
                            jQuery('#formfield_value_time_sec{{ $formFields[$k]->id }}').show().delay(0).fadeIn(
                                'show');
                            jQuery('#formfield_value_time_sec{{ $formFields[$k]->id }}').show().delay(2000).fadeOut(
                                'show');
                            $('html, body').animate({
                                scrollTop: $('#formfield_value_time_two{{ $formFields[$k]->id }}').offset()
                                    .top -
                                    150
                            }, 1000);
                            return false;
                        }
                    @endif
                @endif
            @endfor
        @endfor

        // if (!intFormValid) {
        //     return false;
        // }
        $('#spinner_button').show();

        $('#submit_button').hide();

        $('#category_form').submit();

        // Add more validation for other fields as needed

        // If international form is not valid, prevent form submission


        // Proceed with form submission if international form is valid
        // Your form submission code here
    }

    function validateNumber(event) {

        var key = window.event ? event.keyCode : event.which;

        if (event.keyCode === 8 || event.keyCode === 46) {

            return true;

        } else if (key < 48 || key > 57) {

            return false;

        } else {

            return true;

        }

    }
</script>

<script>
    $(".multiple").select2({
        placeholder: "Select a Form Fields" // Replace with your desired placeholder text
    });

    // $(".multiple").select2({
    //     placeholder: "Select a Form Fields" // Replace with your desired placeholder text
    // });

    function get_sub_select(val, form_id) {
        // alert(val);
        // alert(form_id);

        if(form_id == 42){

            if(val == 129){

                $('#hide_div_59').css('display','block');
                $('#hide_div_60').css('display','none');
                $('#hide_div_64').css('display','none');
                $('#hide_div_65').css('display','none');
                $('#hide_div_66').css('display','none');

                
            }

            if(val == 130){
                $('#hide_div_59').css('display','block');
                $('#hide_div_60').css('display','block');
                $('#hide_div_64').css('display','none');
                $('#hide_div_65').css('display','none');
                $('#hide_div_66').css('display','none');
            }

            if(val == 131){
                $('#hide_div_59').css('display','block');
                $('#hide_div_60').css('display','block');
                $('#hide_div_64').css('display','block');
                $('#hide_div_65').css('display','none');
                $('#hide_div_66').css('display','none');
            }

            if(val == 132){
               $('#hide_div_59').css('display','block');
                $('#hide_div_60').css('display','block');
                $('#hide_div_64').css('display','block');
                $('#hide_div_65').css('display','block');
                $('#hide_div_66').css('display','none');
            }

            if(val == 133){
                $('#hide_div_59').css('display','block');
                $('#hide_div_60').css('display','block');
                $('#hide_div_64').css('display','block');
                $('#hide_div_65').css('display','block');
                $('#hide_div_66').css('display','block');
            }

            if(val == 134 || val == ''){
                $('#hide_div_59').css('display','none');
                $('#hide_div_60').css('display','none');
                $('#hide_div_64').css('display','none');
                $('#hide_div_65').css('display','none');
                $('#hide_div_66').css('display','none');
            }



        }else{

            var url = '{{ url('change_drop_down') }}';

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "form_inner_id": val,
                    "form_id": form_id
                },
                success: function(msg) {
                    document.getElementById('replace_select_' + form_id).innerHTML = msg;
                    $(".multiple").select2({
                        placeholder: "Select a Form Fields" // Replace with your desired placeholder text
                    });
                }
            });

        }

        
    }


    window.onload = custom_function;

    function custom_function() { 

        $('#hide_div_59').css('display','none');
        $('#hide_div_60').css('display','none');


        $('#hide_div_64').css('display','none');
        $('#hide_div_65').css('display','none');

        $('#hide_div_66').css('display','none');


     }


    function get_sub_select_two(val, form_id) {
        // alert(val);
        // alert(form_id);

        var url = '{{ url('change_drop_down_two') }}';

        $.ajax({
            url: url,
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "form_inner_id": val,
                "form_id": form_id
            },
            success: function(msg) {
                document.getElementById('replace_select_two' + form_id).innerHTML = msg;
            }
        });
    }

    @for ($i = 0; $i < count($result1); $i++)
            @for ($k = 0; $k < count($formFields); $k++)

            @if ($result1[$i]->id == '21' && $result1[$i]->type == '6' && $result1[$i]->is_active == '1')

            document.addEventListener('DOMContentLoaded', () => {
            const dateInput = document.getElementById('formfield_value_date{{ $formFields[$k]->id }}');
            
            // Get tomorrow's date
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            // Format the date to yyyy-mm-dd
            const yyyy = tomorrow.getFullYear();
            const mm = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const dd = String(tomorrow.getDate()).padStart(2, '0');
            const minDate = `${yyyy}-${mm}-${dd}`;
            
            // Set the min attribute
            dateInput.setAttribute('min', minDate);
        });
            // document.addEventListener('DOMContentLoaded', (event) => {

                
            //     const dateInput = document.getElementById('formfield_value_date{{ $formFields[$k]->id }}');
            //     const form = document.getElementById('category_form');

            //     // Get today's date
            //     const today = new Date();
            //     // Set tomorrow's date
            //     const tomorrow = new Date(today);
            //     tomorrow.setDate(tomorrow.getDate() + 1);

            //     // Format the dates as yyyy-mm-dd
            //     const formatDate = (date) => {
            //         const yyyy = date.getFullYear();
            //         const mm = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            //         const dd = String(date.getDate()).padStart(2, '0');
            //         return `${yyyy}-${mm}-${dd}`;
            //     };

            //     const todayStr = formatDate(today);
            //     const tomorrowStr = formatDate(tomorrow);

            //     // Set the min and max attributes of the date input to restrict to today and tomorrow
            //     dateInput.setAttribute('min', todayStr);
            //     dateInput.setAttribute('max', tomorrowStr);

            //     // Additional validation on form submission
            //     form.addEventListener('submit', (event) => {
            //         const selectedDate = new Date(dateInput.value);
            //         if (selectedDate < today || selectedDate > tomorrow) {
            //             alert('Please select a date either today or tomorrow.');
            //             event.preventDefault(); // Prevent form submission
            //         }
            //     });
            // });


            @endif
            
            @endfor
    @endfor
</script>
@php
    $packageEnquiryFormId = session('packages_enquiry_form_id');
    if (isset($packageEnquiryFormId)) {
@endphp
        <script>
            // Function will be called on page load
            window.onload = function() {

                // alert('here');
                get_hide_show(2);
            };
        </script>
@php
    }
@endphp 

{{-- @if (isset($formFields[$k]) && isset($formFields[$k]->id))
    <script>
        $("#formfield_value_{{ $formFields[$k]->id }}").select2({
            placeholder: "Select "
            // Add any other Select2 options you need
        });
    </script>
@endif --}}

{{-- @if (isset($formFields) && is_array($formFields))
    @foreach ($formFields as $k => $formField)
        @if (isset($formField->id))
            <script>
                $("#formfield_value_{{ $formField->id }}").select2({
                    placeholder: "Select {{ $formFields[$k]->lable_name }}"
                    // Add any other Select2 options you need
                });
            </script>
        @endif
    @endforeach
@endif --}}
