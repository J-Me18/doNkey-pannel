@extends('layouts.master')
@section('content')
<style>
     .left {
          background-color: green;
          color: white;
          width: fit-content;

          padding: 5px 20px 5px 20px;
          border-radius: 5px;
          /* margin: auto; */
     }

     .right {
          background-color: blue;
          color: white;
          width: fit-content;

          padding: 5px 20px 5px 20px;
          border-radius: 5px;
          /* margin: auto; */
          justify-content: end;

     }

     .names {
          max-height: 100vh;
          overflow-y: scroll;
     }

     .name {
          min-height: 80vh;
          overflow-y: scroll;
     }

     .name>a:hover {
          -webkit-box-shadow: 9px 10px 20px 0px rgba(189, 185, 189, 0.59);
          -moz-box-shadow: 9px 10px 20px 0px rgba(189, 185, 189, 0.59);
          box-shadow: 9px 10px 20px 0px rgba(189, 185, 189, 0.59);
     }



     .menus {
          display: none;
     }

     .closemenus {
          display: none;
     }

     @media only screen and (max-width:320px) {
          .name {

               display: none;
          }

          .menus {
               display: block;
          }
     }
</style>
<div class="container  mesagecontainer">
     <i class="fa fa-solid fa-bars menus"></i>
     <i class="fa fa-solid fa-xmark closemenus"></i>
     <span class="closemenus">X</span>
     <div class="row">



          <div class="col-md-3 name" style="height:70vh;-webkit-box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);
-moz-box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);
box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);">
               @foreach($subscriber as $sub)
               @if($sub->subscriberId==session::get("messagesubscriber"))
               <?php $n = $sub->name; ?>
               @endif

               <a class="btn   w-100 mt-3" href="{{url('chat/'.$sub->subscriberId)}}">{{$sub->name}}</a>
               @endforeach
          </div>
          <div class="col-md-12">
               <div class="container " style="-webkit-box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);
-moz-box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);
box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);border-radius:20px;padding:20px;">
                    <span class="h3">
                         <?php echo $n; ?>
                    </span>

                    <div class="container p-4 names" style="height:70vh;border-top:.5px solid #cdbdbd" id="messagesection"></div>

                    <div class="input-group mb-2">

                         <textarea class="form-control" id="message" placeholder="Message"></textarea>
                         <div class="input-group-prepend">
                              <button type="submit" value="Submit" id="messageid" class="btn btn-primary" style="border-radius:10px">
                                   <i class="fa fa-solid fa-paper-plane"></i>
                              </button>
                              <!-- <input type="submit" value="Submit" id="messageid" class="btn btn-primary" style="border-radius:10px"> -->

                         </div>
                    </div>

               </div>
          </div>
     </div>
</div>
<script type="module">
     // Import the functions you need from the SDKs you need
     import {
          initializeApp
     } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-app.js";
     import {
          getAnalytics
     } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-analytics.js";

     import {
          getDatabase,
          set,
          ref,
          push,
          child,
          onValue,
          onChildAdded
     } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-database.js";
     // TODO: Add SDKs for Firebase products that you want to use
     // https://firebase.google.com/docs/web/setup#available-libraries

     // Your web app's Firebase configuration
     // For Firebase JS SDK v7.20.0 and later, measurementId is optional
     const firebaseConfig = {
          apiKey: "AIzaSyCjF2n53vtKKaWyPLJURHCr8hPVjqzGKg8",
          authDomain: "donkey-18b12.firebaseapp.com",
          projectId: "donkey-18b12",
          storageBucket: "donkey-18b12.appspot.com",
          messagingSenderId: "1025418662407",
          appId: "1:1025418662407:web:947f0f8e534af293b8d0a2",
          measurementId: "G-MXHJ3J1FHF"
     };

     // Initialize Firebase
     const app = initializeApp(firebaseConfig);
     const analytics = getAnalytics(app);

     const database = getDatabase(app);
     var name = "admin->{{session::get('messagesubscriber')}}";
     var name1 = "{{session::get('messagesubscriber')}}->admin";
     messageid.addEventListener('click', (e) => {
          var message = document.getElementById('message').value;


          const id = push(child(ref(database), 'messages')).key;
          set(ref(database, "messages/" + id), {
               name: name,
               message: message
          });
          document.getElementById('message').value = "";
     });
     const newmsg = ref(database, 'messages/');
     onChildAdded(newmsg, (data) => {

          if (data.val().name == name1) {
               // console.log(data.val().message)
               $('#messagesection').append("<div class='row mt-3 '><div class='col-4 '><div class='left'>" + data.val().message + "</div></div><div class='col-8'></div></div>")

          }
          if (data.val().name == name) {
               $('#messagesection').append("<div class='row mt-3 '><div class='col-8'></div><div class=' col-4'><div class='right'>" + data.val().message + "</div></div></div>")
          }
     });

     $('.menus').on('click', function() {
          $('.menus').css('display', "none");
          $('.name').css('display', "block");
          $('.closemenus').css('display', "block");
     });

     $('.closemenus').on('click', function() {
          $('.closemenus').css('display', "none");
          $('.name').css('display', "none");
          $('.menus').css('display', "block");
     })
</script>
@endsection