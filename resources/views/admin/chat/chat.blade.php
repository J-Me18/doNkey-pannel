@extends('layouts.master')

@section('content')
<style>
.ml-4{
width:250px;
}
    .left {
        background-color: green;
        color: white;
        width: 150px;

        padding: 5px 20px 5px 20px;
        border-radius: 5px;
        /* margin: auto; */
    }

    .right {
        background-color: blue;
        color: white;
        width: 150px;

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

    .messagerightcontainer {
        /* background-color: black; */
        padding: 15px;
        border-radius: 10px;
        /* -webkit-box-shadow: 4px 9px 23px -1px rgba(184, 175, 184, 1);
          -moz-box-shadow: 4px 9px 23px -1px rgba(184, 175, 184, 1);
          box-shadow: 4px 9px 23px -1px rgba(184, 175, 184, 1); */
    }

    .messagerightcontainer .right {
        /* background-color: #6262ff; */
        background-color: #1b68ff;
        color: white;
        overflow-wrap: anywhere;
    }

    .messageleftcontainer {
        /* background-color: black; */
        padding: 15px;
        border-radius: 10px;
        /* -webkit-box-shadow: 4px 9px 23px -1px rgba(184, 175, 184, 1);
          -moz-box-shadow: 4px 9px 23px -1px rgba(184, 175, 184, 1);
          box-shadow: 4px 9px 23px -1px rgba(184, 175, 184, 1); */
    }

    .messageleftcontainer .left {
        /* background-color: #41c141; */
        background-color: #17a2b8;
        color: white;
        overflow-wrap: anywhere;
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

        .col-4 {
            min-width: 100% !important;
        }

        .col-4 .left {
            min-width: auto;
        }

        .col-8 {
            min-width: 100% !important;
        }

        .col-8 .right {
            min-width: auto;
        }
    }
</style>
<div class="container  mesagecontainer">

    <i class="fa fa-solid fa-bars menus"></i>
    <i class="fa fa-solid fa-xmark closemenus"></i>
    <span class="closemenus">X</span>
    <div class="row">

        <div class="col-md-11">
            <div class="container " style="-webkit-box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);
-moz-box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);
box-shadow: 9px 10px 20px 0px rgba(189,185,189,0.59);border-radius:20px;padding:20px;">
                <span class="h3">
                    {{("Team Chat")}}
                </span>

                <div class="container p-4 names" style="height:70vh;border-top:.5px solid #cdbdbd" id="messagesection"></div>

                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Title" title="Title Of Message" id="titleofmessage">

                </div>

                <div class="input-group mb-2">
                    <!-- <input type="text" class="form-control" id="titleofmessage"> -->
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
    var name = ["{{Session::get('messagebyid')}}", "{{Session::get('messagebyname')}}", "{{Session::get('rolename')}}"];
    // var name1 = "{{session::get('messagesubscriber')}}->admin";
    messageid.addEventListener('click', (e) => {
        if (document.getElementById('message').value != "") {
            var message = [{
                'message': document.getElementById('message').value,
                "title": document.getElementById('titleofmessage').value
            }];


            const id = push(child(ref(database), 'messages')).key;
            set(ref(database, "messages/" + id), {
                name: name,
                message: message
            });
            document.getElementById('message').value = "";
            document.getElementById('titleofmessage').value = "";
        }
    });
    const newmsg = ref(database, 'messages/');
    var countdata = parseInt("0");
    var $countmessage = 1;
    onChildAdded(newmsg, (data) => {
        // console.log(data.val().name)
        // console.log(data.val().message)
        //   dd((data.val().name[0]));
        if (data.val().name[0] == "{{Session::get('messagebyid')}}") {
            $('#messagesection').append("<div class='row mt-3 '><div class='col-md-8 col-8'></div><div class=' col-md-4 col-4'><div style='border-bottom:1px dotted black;text-align: end;'><span >You</span></div></div></div><div class='row mt-1 '><div class='col-md-8 col-8'></div><div class=' col-md-4 col-4 messagerightcontainer '><div  class='pull-right' >" + data.val().message[0].title + "<div class='right'>" + data.val().message[0].message + "</div></div></div></div>")

            countdata = countdata + 1;
        } else {
            $('#messagesection').append("<div class='row mt-3 '><div class='col-md-4 col-4 '><div style='border-bottom:1px dotted black'>" + data.val().name[1] + "</div></div><div class='col-md-8 col-8'></div></div><div class='row mt-1 '><div class='messageleftcontainer col-md-4 col-4 leftsection'><div class='ml-4'  >" + data.val().message[0].title + "<div class='left ml-5'>" + data.val().message[0].message + "</div></div></div><div class='col-md-8 col-8'></div></div>")
            countdata = countdata + 1;
        }



        // $("#messagesection left").last().focus();
        $('#messagesection').animate({
            scrollTop: $('#messagesection').prop("scrollHeight")
        }, 500);
        localStorage.setItem("countmessagewithadmins", countdata);
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