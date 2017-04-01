@extends('layouts.base')

@section('body')
  <div class="container">
    <div class="registration">
        <div class="registration_left">
         <!-- [if IE] 
          < link rel='stylesheet' type='text/css' href='ie.css'/>  
         [endif] -->  
          
         <!-- [if lt IE 7]>  
          < link rel='stylesheet' type='text/css' href='ie6.css'/>  
         <! [endif] -->  
         <script>
            (function() {
          
            // Create input element for testing
            var inputs = document.createElement('input');
            
            // Create the supports object
            var supports = {};
            
            supports.autofocus   = 'autofocus' in inputs;
            supports.required    = 'required' in inputs;
            supports.placeholder = 'placeholder' in inputs;
          
            // Fallback for autofocus attribute
            if(!supports.autofocus) {
              
            }
            
            // Fallback for required attribute
            if(!supports.required) {
              
            }
          
            // Fallback for placeholder attribute
            if(!supports.placeholder) {
              
            }
            
            // Change text inside send button on submit
            var send = document.getElementById('register-submit');
            if(send) {
              send.onclick = function () {
                this.innerHTML = '...Sending';
              }
            }
          
           })();
         </script>
        @if( \Auth::user() )
          <h1>Hello {{ \Auth::user()->name }} </h1>        
        @else
          <div class="inner-content">
            <h2>مازلت زائر؟<span> قم بتسجيل حساب لتتمتع بخدمات زاخر </span></h2>
            <div class="registration_form">
              <!-- Form -->
              @if( $errors->any() )
              <ul class="alert alert-danger">
                @foreach( $errors->all() as $error )
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              @endif
              {!! Form::open(['url' => 'users/signup']) !!}
              <div class="input-form">
                <label> الإسم الأول 
                  <input name="fname" placeholder="الاسم الأول"  style="width: 100%;" class="form-control" type="text" tabindex="1">
                </label>
              </div>
              <div class="input-form">
                <label> الإسم الأخير
                  <input name="lname" placeholder="الاسم الأخير" style="width: 100%;" class="form-control" type="text" tabindex="2">
                </label>
              </div>
              <div class="input-form">
                <label> البريد الإلكتروني 
                  <input name="email" placeholder="البريد الإلكتروني" style="width: 100%;" class="form-control" type="email" tabindex="3">
                </label>
              </div class="input-form">             
              <div>
                <label> الرقم السري 
                  <input name="password" style="width: 100%;" class="form-control" type="password" tabindex="4">
                </label>
              </div class="input-form">            
              <div>
                <label> تاكيد الرقم السري 
                  <input name="password_confirmation"  style="width: 100%;" class="form-control" type="password" tabindex="4">
                </label>
              </div>  
              <div class="sky-form input-form">
                <label class="checkbox"><input type="checkbox" name="checkbox" ><span class="buying_options">أوافق على<a class="fancybox" href="#conditions"> شروط الإستخدام</a> </span></label>
              </div>
              <div class="input-form">
                <input type="submit" class="btn btn-success login-btn" value="انهاء" id="register-submit">
              </div>
              {!! Form::close()!!}
              <!-- /Form -->
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        @endif
        <div id="conditions" style="display: none;">
          <div class="content">
            <h2>الشروط والضوابط</h2>
            <p>
              هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
              إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
              ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.
              هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.
            </p>
          </div>
        </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
    $('.fancybox').fancybox({
      openEffect  : 'elastic',
      closeEffect : 'elastic',
      helpers : {
        title : {
          type : 'over'
        }
      }
    });
  </script>
@endsection