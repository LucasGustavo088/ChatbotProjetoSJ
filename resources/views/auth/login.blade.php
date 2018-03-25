@extends('layouts.app')

@section('content')
@if ($errors->has('email'))
<div onclick="$('#mensagem_alerta').hide();" style="position: fixed; top:0px; left: 200px; right: 200px;" class="btn-danger btn" id="mensagem_alerta">
   E-mail ou senha inválidos.   
   <span style="float: right;" >
       X
   </span>  
</div>
@endif
<div onclick="$('#email').val('funcionario@email.com'); $('#password').val('funcionario');" style="position: fixed; top:10px; left: 10px; height: 30px; width: 160px;" class="btn-success btn" id="mensagem_alerta">
   Preencher login   
</div>

<div class="container-login100">
    <div class="wrap-login100 p-t-20 p-b-20">
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
            @csrf
            <span class="login100-form-avatar">
                <img src="images/cartorio-sp.png" alt="AVATAR">
            </span>
            <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
                <input id="email" type="email" class="input100 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                <span class="focus-input100" data-placeholder="login"></span>
            </div>
            
            <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                <input id="password" type="password" class="input100 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                <span class="focus-input100" data-placeholder="Senha"></span>
            </div>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>
<div id="dropDownSelect1"></div>
<script>
            
    $(document).ready(function() {

        /*==================================================================
        [ Focus input ]*/
        $('.input100').each(function(){
            $(this).on('blur', function(){
                if($(this).val().trim() != "") {
                    $(this).addClass('has-val');
                }
                else {
                    $(this).removeClass('has-val');
                }
            })    
        })
    
    
        /*==================================================================
        [ Validate ]*/
        var input = $('.validate-input .input100');

        // $('.validate-form').on('submit',function(){
        // 	var check = true;

        // 	for(var i=0; i<input.length; i++) {
        // 		if(validate(input[i]) == false){
        // 			showValidate(input[i]);
        // 			check=false;
        // 		}
        // 	}

        // 	return check;
        // });


        $('.validate-form .input100').each(function(){
            $(this).focus(function(){
            hideValidate(this);
            });
        });

        function validate (input) {
            if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
                if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                    return false;
                }
            }
            else {
                if($(input).val().trim() == ''){
                    return false;
                }
            }
        }

        function showValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-validate');
        }

        function hideValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).removeClass('alert-validate');
        }
        
        
    });
</script>
@endsection
